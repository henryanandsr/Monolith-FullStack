import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

const BeliBarang = () => {
  const { id } = useParams();
  const [quantity, setQuantity] = useState(1);
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
  const totalCost = barang.harga * quantity;

  const handleBuy = () => {
    if (barang.stok >= quantity) {
        const accessToken = localStorage.getItem('access_token');
        console.log('Retrieved token:', accessToken); 

        // create order data
        const orderData = {
            product_id: id,
            quantity: quantity,
        };

        axios.post('http://localhost:8001/api/barang/create', orderData, {
            headers: {
                Authorization: `Bearer ${accessToken}`,
            },
        })
            .then(response => {
                console.log(response);
                alert('Pembelian berhasil');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Pembelian gagal');
            });
        // update stock in http://localhost:8080/barang/{id}
        const newStock = barang.stok - quantity;
        axios.put(`http://localhost:8080/barang/stok/${id}`, {stok: newStock}, {withCredentials: false})
            .then(response => {
                console.log(response);
            })
            .catch(error => console.error('Error:', error));
            
    } else {
        alert('Stok tidak cukup');
    }
};

  return (
    <div className="p-4 m-4 bg-blue-50 rounded-lg shadow-md">
      <h2 className="text-xl font-bold mb-2">{barang.nama}</h2>
      <p className="text-gray-700 mb-1">Harga: {barang.harga}</p>
      <p className="text-gray-700 mb-3">Stok: {barang.stok}</p>
      <label className="block mb-2">
        Jumlah:
        <input type="number" min="1" value={quantity} onChange={(e) => setQuantity(Number(e.target.value))} className="mt-1 w-full rounded-md border-gray-300 shadow-sm" />
      </label>
      <p className="text-gray-700 mb-3">Total: {totalCost}</p>
      <button onClick={handleBuy} className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Beli
      </button>
    </div>
  );
};

export default BeliBarang;
