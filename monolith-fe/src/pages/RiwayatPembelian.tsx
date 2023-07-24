import axios from 'axios';
import React, { useEffect, useState } from 'react';

type Purchase = {
  id: number;
  user_id: number;
  product_id: string;
  quantity: number;
  created_at: string;
  updated_at: string;
  product?: any;
};

const RiwayatPembelian = () => {
  const [currentPage, setCurrentPage] = useState(1);
  const [purchasesPerPage] = useState(10);
  const [purchases, setPurchases] = useState<Purchase[]>([])

  useEffect(() => {
    const token = localStorage.getItem('access_token');
    console.log('Retrieved token:', token)
    axios.get('https://merciful-nose-production.up.railway.app/api/orders/user', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
    .then(async response => {
      const purchasesData = response.data.data;

      // Fetch detail product from single service
      const purchasesWithProductDetails = await Promise.all(purchasesData.map(async (purchase: Purchase) => {
        const productResponse = await axios.get(`http://localhost:8080/barang/${purchase.product_id}`,{withCredentials: false});
        return {
          ...purchase,
          product: productResponse.data.data,
        };
      }));
      setPurchases(purchasesWithProductDetails);
    })
    .catch(error => {
      console.error('There was an error!', error);
    });
  }, []);      

  const indexOfLastPurchase = currentPage * purchasesPerPage;
  const indexOfFirstPurchase = indexOfLastPurchase - purchasesPerPage;
  const currentPurchases = purchases.slice(indexOfFirstPurchase, indexOfLastPurchase);

  const paginate = (pageNumber: React.SetStateAction<number>) => setCurrentPage(pageNumber);

  return (
    <div className="p-4 m-4">
      <h1 className="text-center text-xl font-bold pb-4">Riwayat Pembelian</h1>
      {currentPurchases.map((purchase: Purchase) => (
        <div className="bg-blue-50 p-4 rounded-lg shadow-md mb-4" key={purchase.id}>
          <h3 className="text-xl font-bold">{purchase.product?.nama}</h3> {}
          <p className="text-gray-700">Jumlah: {purchase.quantity}</p>
          <p className="text-gray-700">Total: {purchase.quantity * purchase.product?.harga} {}</p>
        </div>
      ))}
      {/* Pagination */}
      <div>
        {Array.from({ length: Math.ceil(purchases.length / purchasesPerPage) }, (_, index) => (
          <button key={index} onClick={() => paginate(index + 1)}>
            {index + 1}
          </button>
        ))}
      </div>
    </div>
  );
};

export default RiwayatPembelian;
