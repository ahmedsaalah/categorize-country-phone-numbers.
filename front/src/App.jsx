import React, { useState, useEffect } from 'react';
import './App.css';
import styled from 'styled-components'
import Select from 'react-select';
import { useTable } from 'react-table'

const Styles = styled.div`

  padding: 1rem;
  .fliters {
    display:flex;
    flex-direction:row;
  }
  table {
    border-spacing: 0;
    border: 1px solid black;

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
      <thead>
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
  const [selectCountryCodeFilter, setSelectCountryCodeFilter] = useState(null);
  const [selectPhoneStateFilter, setSelectPhoneStateFilter] = useState(null);
  const [page, setPage] = useState(1);
  const [hasNext, setHasNext] = useState(true)

  useEffect(() => {
    loadData();

  }, []);
  useEffect(() => {
    loadData();
  }, [page, phoneStateFilter, countryCodeFilter]);
  const loadData = () => {
    fetch(`http://localhost:8080/api/customers?page=${page}${phoneStateFilter ? `&state=${phoneStateFilter}` : ""
      }${countryCodeFilter ? `&country=${countryCodeFilter}` : ""}`)
      .then(response => response.json())
      .then(data => {
        // do something with your data
        setCustomers(data.data);
        setLoading(false);
        setHasNext(Boolean(data.next_page_url));


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
    return ('<div>loading</div>'
    );
  }
  if (customers === undefined || customers === null) {
    return (
      '<div>failed to load</div>'
    );
  }
  const statesOptions = [
    { value: null, label: 'Select' },
    { value: '1', label: 'OK' },
    { value: '0', label: 'NOK' },
  ];
  const countryOptions = [
    { value: null, label: 'Select' },
    { value: 'Cameroon', label: 'Cameroon' },
    { value: 'Ethiopia', label: 'Ethiopia' },
    { value: 'Morocco', label: 'Morocco' },
    { value: 'Mozambique', label: 'Mozambique' },
    { value: 'Uganda', label: 'Uganda' },
  ];
  return (

    <Styles>
      <div className='fliters'>
        <Select
          value={selectCountryCodeFilter}
          onChange={(value) => {
            setPhoneStateFilter(value.value)
            setSelectCountryCodeFilter(value)
            setPage(1)
          }}
          options={statesOptions}
        />

        <Select
          value={selectPhoneStateFilter}
          onChange={(value) => {
            setCountryCodeFilter(value.value)
            setSelectPhoneStateFilter(value)
            setPage(1)
          }}
          options={countryOptions}
        />
      </div>
      <Table columns={columns} data={customers} />
      <div>
        <button disabled={page === 1} onClick={() => setPage(page - 1 > 0 ? page - 1 : 1)}>Previous</button>

        <button disabled={!hasNext} onClick={() => setPage(page + 1)}>Next</button>


      </div>
    </Styles>
  )
}

export default App
