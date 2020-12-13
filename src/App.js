import React, { useState, useEffect } from 'react'
import stc from 'string-to-color'

const apiUrl = 'http://localhost:5000/api'

const fetchUsers = async () => {
  return fetch(`${apiUrl}/users`)
    .then(res => res.json())
}

const App = () => {
  const [users, setUsers] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetchUsers()
      .then(users => setUsers(users))
      .catch(err => setError(err));
  }, []);

  if (error) return <h1>{error.message}</h1>

  return (
    <div style={{ display: 'flex', flexWrap: 'wrap' }}>
      {users.map(u => (
        <div key={u.id} style={{ display: 'flex', alignItems: 'center', background: '#eee', padding: '0.5em 1em', borderRadius: 4, width: '31%', margin: '1%', boxSizing: 'border-box' }}>
          <img src={u.avatar} alt={u.lastname} style={{ maxHeight: 64, maxWidth: 64, borderRadius: 32, marginRight: 20 }} />
          <div>
            <h4 style={{ margin: '0.125em 0' }}>{u.firstname} {u.lastname}</h4>
            <p>{u.job}</p>
            {
              u.skills.map(sk => (
                <span key={sk} style={{ borderRadius: 2, padding: 2, marginRight: 5, fontSize: 12, background: stc(sk), color: '#fff' }}>{sk}</span>
              ))
            }
          </div>
        </div>
      ))}
    </div>
  )
}

export default App