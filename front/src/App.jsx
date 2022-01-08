import React, { useState, useEffect } from 'react';
import './App.css';
import styled from 'styled-components'
import Select from 'react-select';
import { useTable } from 'react-table'

const Styles = styled.div`

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;

  .pagination,
  .fliters {
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    width: 1500px;
    max-width: 90%;
  }
  .pagination > button {
    padding: 15px 25px;
    width: 150px;
    font-weight: 600;
    background-color: #2c2089;
    color: white;
    border-radius: 5px;
  }

  table {
    border-spacing: 0;
    border: 1px solid black;
    width: 1500px;
    max-width: 90%;
    margin: 1rem;

    tr {
      :last-child {
        td {
          border-bottom: 0;
        }
      }
    }

    th,
    td {
      margin: 0;
      padding: 0.5rem;
      border-bottom: 1px solid black;
      border-right: 1px solid black;

      :last-child {
        border-right: 0;
      }
    }
  }
  .previous {
    background-color: #f1f1f1;
    color: black;
  }
  
  .next {
    background-color: #04AA6D;
    color: white;
  }
  
  .round {
    border-radius: 50%;
  }
  
  .filter {
    margin-right: auto;
  }
  .table-header{
    border-bottom: solid 3px blue;
    background: rgb(44, 32, 137);
    color: white;
    font-weight: bold;
  }
`

function Table({ columns, data }) {
  // Use the state and functions returned from useTable to build your UI
  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    rows,
    prepareRow,
  } = useTable({
    columns,
    data,
  })

  // Render the UI for your table
  return (
    <table {...getTableProps()}>
      <thead className='table-header'>
        {headerGroups.map(headerGroup => (
          <tr {...headerGroup.getHeaderGroupProps()}>
            {headerGroup.headers.map(column => (
              <th {...column.getHeaderProps()}>{column.render('Header')}</th>
            ))}
          </tr>
        ))}
      </thead>
      <tbody {...getTableBodyProps()}>
        {rows.map((row, i) => {
          prepareRow(row)
          return (
            <tr {...row.getRowProps()}>
              {row.cells.map(cell => {
                return <td {...cell.getCellProps()}>{cell.render('Cell')}</td>
              })}
            </tr>
          )
        })}
      </tbody>
    </table>
  )
}


function App() {
  const [loading, setLoading] = useState(true);
  const [customers, setCustomers] = useState([]);
  const [countryCodeFilter, setCountryCodeFilter] = useState(null);
  const [phoneStateFilter, setPhoneStateFilter] = useState(null);
  const [page, setPage] = useState(1);
  const [limit, setLimit] = useState(10);
  const [hasNext, setHasNext] = useState(true)

  useEffect(() => {
    loadData();

  }, []);
  useEffect(() => {
    loadData();
  }, [page, phoneStateFilter, countryCodeFilter, limit]);
  const loadData = () => {
    fetch(`http://localhost:8080/api/customers?page=${page}${phoneStateFilter ? `&state=${phoneStateFilter}` : ""
      }${countryCodeFilter ? `&country=${countryCodeFilter}` : ""
      }${limit ? `&limit=${limit}` : ""}`)
      .then(response => response.json())
      .then(customers => {
        const customersData = customers.data.map(customer => {
          return {
            ...customer,
            state: customer.state ? "OK" : "NOK"
          }
        })
        setCustomers(customersData);
        setLoading(false);
        setHasNext(Boolean(customers.next_page_url));


      })
      .catch(error => {
      });
  };
  const columns = React.useMemo(
    () =>

      [
        {
          Header: 'Country',
          accessor: 'country',
        },
        {
          Header: 'State',
          accessor: 'state',
        },
        {
          Header: 'Country Code',
          accessor: 'code',
        },
        {
          Header: 'Phone num',
          accessor: 'phone_num',
        },
      ],
    []
  )

  if (loading === true) {
    return (<div>loading</div>
    );
  }
  if (customers === undefined || customers === null) {
    return (
      <div>failed to load</div>
    );
  }
  const statesOptions = [
    { value: null, label: 'State' },
    { value: '1', label: 'OK' },
    { value: '0', label: 'NOK' },
  ];
  const countryOptions = [
    { value: null, label: 'Country' },
    { value: 'Cameroon', label: 'Cameroon' },
    { value: 'Ethiopia', label: 'Ethiopia' },
    { value: 'Morocco', label: 'Morocco' },
    { value: 'Mozambique', label: 'Mozambique' },
    { value: 'Uganda', label: 'Uganda' },
  ];
  const itemsPerPageOptions = [
    { value: null, label: 'Per Page' },
    { value: 5, label: 5 },
    { value: 10, label: 10 },
    { value: 25, label: 25 },
    { value: 50, label: 50 },
  ];
  const selectLimitOption = limit ? itemsPerPageOptions.find(option => option.value === limit) : itemsPerPageOptions[0];
  const selectCountryOption = countryCodeFilter ? countryOptions.find(option => option.value === countryCodeFilter) : countryOptions[0];
  const selectStateOption = phoneStateFilter ? statesOptions.find(option => option.value === phoneStateFilter) : statesOptions[0];


  return (

    <Styles>
      <div className='fliters'>
        <Select
          value={selectStateOption}
          onChange={(value) => {
            setPhoneStateFilter(value.value)
            setPage(1)
          }}
          options={statesOptions}
          defaultValue={selectStateOption}

        />

        <Select
          value={selectLimitOption}
          onChange={(value) => {
            setLimit(value.value)
            setPage(1)
          }}
          options={itemsPerPageOptions}
          defaultValue={selectLimitOption}

        />

        <Select
          value={selectCountryOption}
          onChange={(value) => {
            setCountryCodeFilter(value.value)
            setPage(1)
          }}
          options={countryOptions}
          defaultValue={selectCountryOption}


        />
      </div>
      <Table columns={columns} data={customers} />
      <div className='pagination'>
        <button disabled={page === 1} onClick={() => setPage(page - 1 > 0 ? page - 1 : 1)}>Previous</button>

        <button disabled={!hasNext} onClick={() => setPage(page + 1)}>Next</button>


      </div>
    </Styles>
  )
}

export default App
