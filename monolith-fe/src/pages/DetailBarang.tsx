import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';

const DetailBarang = () => {
  const { id } = useParams();
  const [barang, setBarang] = useState<Barang>({id: "", nama: "", harga: 0, stok: 0});
  type Barang = {
    id: string,
    nama: string,
    harga: number,
    stok: number
  }
  useEffect(() => {
    axios.get(`http://localhost:8080/barang/${id}`, {withCredentials: false})
      .then(response => {
        setBarang(response.data.data);
        console.log(response.data.data);
      })
      .catch(error => console.error('Error:', error));
  }, [id]);
  

  return (
    <div className="p-4 m-4 bg-blue-50 rounded-lg shadow-md">
      <h2 className="text-xl font-bold mb-2">{barang.nama}</h2>
      <p className="text-gray-700 mb-1">Harga: {barang.harga}</p>
      <p className="text-gray-700 mb-3">Stok: {barang.stok}</p>
      <Link to={`/beli/${barang.id}`} className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Beli
      </Link>
    </div>
  );
};

export default DetailBarang;
