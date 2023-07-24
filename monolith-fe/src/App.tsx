import React from 'react';
import {
  BrowserRouter as Router,
  Routes,
  Route
} from "react-router-dom";
import Register from './pages/Register';
import Login from './pages/Login';
import KatalogBarang from './pages/KatalogBarang';
import DetailBarang from './pages/DetailBarang';
import './App.css';
import BeliBarang from './pages/BeliBarang';
import RiwayatPembelian from './pages/RiwayatPembelian';

function App() {
  return (
    <div>
    <Router>
    <Routes>
      <Route path="/register" element={<Register />} />
      <Route path="/login" element={<Login />} />
      <Route path="/KatalogBarang" element={<KatalogBarang />} />
      <Route path="/barang/:id" element={<DetailBarang/>} />
      <Route path="/beli/:id" element={<BeliBarang/>} />
      <Route path="/riwayat" element={<RiwayatPembelian/>}/>
    </Routes>
  </Router>
  </div>
  );
}

export default App;
