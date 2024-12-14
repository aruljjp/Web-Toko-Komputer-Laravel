<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jayacom @yield("title")</title>

  @include("layout.header")
</head>
<style>
  .container-fluid{padding-left: 1px;padding-right: 1px;margin-right: 1px;margin-left: 1px}
  .card-head{text-align: center}
  h1{text-align: center;font-family: Arial, Helvetica, sans-serif;margin-top:10px;margin-bottom: 10px;}
</style>

<body class="hold-transition sidebar-small">
  <div class="wrapper">
  
    @include('layout.navbar')

    @include('layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content" style="padding:10px">
        <div class="container-fluid">
          <div class="row md-2" style="margin-left: 1px;margin-right:1px">
            <div class="col-md-8" style="padding-left: 1px;padding-right:1px">
              <h1>@yield("page_title")</h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
              <ol class="breadcrumb float-md-right">
                <li class="breadcrumb-item"><a href="#">@yield("bc")</a></li>
                <li class="breadcrumb-item active">@yield("subbc")</li>
              </ol>
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield("content")
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
  </div>
  <!-- ./wrapper -->

  @include('layout.footer')
</body>

</html>