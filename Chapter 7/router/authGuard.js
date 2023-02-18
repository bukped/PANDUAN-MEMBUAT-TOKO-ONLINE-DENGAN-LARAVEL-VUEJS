const productGuard = (to, from, next) => {
  // cek apakah halaman yang dituju adalah halaman produk
  if (to.name === "ProductView") {
  // jika halaman produk, lanjutkan ke halaman produk
  next();
  } else if (!localStorage.getItem("access_token")) {
  // jika belum login, redirect ke halaman login
  next({name: "FirstView"});
  } else {
  // jika sudah login, lanjutkan ke halaman tujuan
  next();
  }
  };
  
  export default productGuard;