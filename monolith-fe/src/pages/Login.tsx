import React, { ChangeEvent, FormEvent, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Link } from 'react-router-dom';

const Login = () => {
  const [formData, setFormData] = useState({
    usernameOrEmail: "",
    password: ""
  });
  
  const navigate = useNavigate();

  const handleChange = (e : ChangeEvent<HTMLInputElement>) => {
    setFormData({...formData, [e.target.name]: e.target.value});
  }

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    const response = await fetch('http://localhost:8001/api/auth/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        email: formData.usernameOrEmail,
        password: formData.password
      })
    });
    
    if (response.ok) {
      const data = await response.json();
      localStorage.setItem('access_token', data.access_token);
      navigate('/katalogbarang');
    } else {
      console.log("Login failed");
      if (response.status === 401) {
        localStorage.removeItem('access_token');
        navigate('/login');
      }
    }
  };

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <form onSubmit={handleSubmit} className="p-6 bg-blue-200 rounded shadow-md">
            <h1 className="text-4xl font-bold mb-8 text-center">Login</h1>
            <input className="border border-gray-300 p-2 mb-4 w-full" type="text" name="usernameOrEmail" placeholder="Username or Email" onChange={handleChange} />
            <input className="border border-gray-300 p-2 mb-4 w-full" type="password" name="password" placeholder="Password" onChange={handleChange} />
            <div className = "flex justify-between">
                <button type="submit" className="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
                <Link to = "/register" className = "mt-2 opacity-50">Register</Link>
            </div>
        </form>
    </div>
  )
}

export default Login;
