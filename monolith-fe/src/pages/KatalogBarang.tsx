import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

const KatalogBarang = () => {
  const [currentPage, setCurrentPage] = useState(1);
  const [productsPerPage] = useState(10);
  const [barangs, setBarangs] = useState<Barang[]>([]);
  type Barang = {
    id: string,
    nama: string,
    harga: number,
    stok: number
  }
  useEffect(() => {
    console.log("benar")
    axios.get('http://localhost:8080/barang', {withCredentials: false})
      .then(response => {
        setBarangs(response.data.data);
        console.log(response.data.data); // log the received data
      })
      .catch(error => console.error('Error:', error));
  }, []);

  // calculate index of last product in cur page
  const indexOfLastProduct = currentPage * productsPerPage;
  // calculate index of first product in cur page
  const indexOfFirstProduct = indexOfLastProduct - productsPerPage;
  //get product
  const currentProducts = barangs.slice(indexOfFirstProduct, indexOfLastProduct);

  // Change page
  const paginate = (pageNumber: React.SetStateAction<number>) => setCurrentPage(pageNumber);

  return (
    <div className = "p-4 m-4">
    <h1 className = "text-center text-2xl font-bold pb-4">Katalog Barang</h1>
            {currentProducts.map(barang => (
              <div key={barang.id} className = "bg-blue-200 my-3 p-2 rounded-md">
                <h2 className = "text-xl font-bold">{barang.nama}</h2>
                <p>Harga : {barang.harga}</p>
                <p>Stock : {barang.stok}</p>
                <Link to = {`/barang/${barang.id}`} className = "text-blue-600">Detail</Link>
              </div>
            ))}
      {/* Pagination */}
      <div>
        {Array.from({ length: Math.ceil(barangs.length / productsPerPage) }, (_, index) => (
          <button key={index} onClick={() => paginate(index + 1)}>
            {index + 1}
          </button>
        ))}
      </div>
    </div>
  );
};

export default KatalogBarang;
