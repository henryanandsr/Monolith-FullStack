import React, { ChangeEvent, FormEvent, useState } from 'react';
import axios, {AxiosError} from 'axios';
import { Link } from 'react-router-dom';

const Register = () => {
  const [formData, setFormData] = useState({
    first_name: "",
    last_name: "",
    username: "",
    email: "",
    password: ""
  });

  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<string | null>(null);

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    setFormData({...formData, [e.target.name]: e.target.value});
  }

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
  
    if (formData.password.length < 8) {
      setError('Password should be at least 8 characters');
      setSuccess(null);
      return;
    }
    try {
      console.log(formData)
      const response = await axios.post('https://merciful-nose-production.up.railway.app/api/register', formData);
      console.log(response.data);
      setSuccess('User registered successfully');
      setError(null); 
    } catch (error) {
      const axiosError = error as AxiosError;
      if (axiosError.response && axiosError.response.status === 422) {
          setError("Username or email already in use");
          setSuccess(null);
      } else {
          setError("An error occurred during registration");
          setSuccess(null);
      }
    }
  };  

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <form onSubmit={handleSubmit} className="p-6 bg-blue-200 rounded shadow-md">
            <h1 className="text-4xl font-bold mb-8 text-center">Register</h1>
            <input className="border border-gray-300 p-2 mb-4 w-full" type="text" name="first_name" placeholder="First Name" onChange={handleChange} />
            <input className="border border-gray-300 p-2 mb-4 w-full" type="text" name="last_name" placeholder="Last Name" onChange={handleChange} />
            <input className="border border-gray-300 p-2 mb-4 w-full" type="text" name="username" placeholder="Username" onChange={handleChange} />
            <input className="border border-gray-300 p-2 mb-4 w-full" type="email" name="email" placeholder="Email" onChange={handleChange} />
            <input className="border border-gray-300 p-2 mb-4 w-full" type="password" name="password" placeholder="Password" onChange={handleChange} />
            <div className= "flex justify-between">
                <button type="submit" className="bg-blue-600 text-white px-4 py-2 rounded">Register</button>
                <Link to="/login" className="mt-4 opacity-60 ">Have an account? Login here</Link>
            </div>
            {error && <p className="text-red-500">{error}</p>}
            {success && <p className="text-green-500">{success}</p>}
        </form>
    </div>
  )
}

export default Register;
