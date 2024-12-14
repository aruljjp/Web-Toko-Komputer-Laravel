@extends('layout2.template')
@section('content')
<style>
   @media screen and (max-width: 900px)  {
    .map{width: 350px}
  }
</style>
<div class="container">
    <div class="row" style="margin-top: 10px">
      <div class="col">
          <h5 class="text-center">ABOUT US</h5>
          <p>
            Aplikai Toko Kami adalah Aplikasi toko yang menyediakan berbagai macam peralatan elektronik dan lain-lain.
          </p>
          {{-- <p class="text-center">
            <a href="" class="btn btn-outline-secondary">
              Baca Selengkapnya
            </a>      
          </p> --}}
        </div>
        <div class="col">
          <h5 class="text-left">Our Address</h5>
          <p>
            Jl. Serayu Timur 155 Taman Kota Madiun Jawa timur,Indonesia,Telp:(+62)351 452329,Email: info@ageecomputer.com
          </p>
          <h5 class="text-left">Opening Hours</h5>
          <p>Monday to Sunday: 08:00 AM - 05:00 PM</p>
          <p></p>
          {{-- <p class="text-center">
            <a href="" class="btn btn-outline-secondary">
              Baca Selengkapnya
            </a>      
          </p> --}}
        </div>
      </div>
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2796.125335422395!2d111.5309636801149!3d-7.648873471064312!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7100245b78d9d94a!2sAgee+Computer!5e0!3m2!1sen!2sid!4v1552866781718" width="1100" height="400" frameborder="0" style="border:0"></iframe>
      <!-- end tentang toko -->
    </div>
</div>
@endsection