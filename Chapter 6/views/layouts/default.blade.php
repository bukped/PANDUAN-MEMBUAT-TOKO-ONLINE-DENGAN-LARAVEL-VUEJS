<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WafaAdmin</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('before-style')
</head>

<body>
    {{-- Sidebar --}}
    @include('includes.sidebar')

    <div id="right-panel" class="right-panel">
        {{-- Navbar --}}
        @include('includes.navbar')

        <div class="content">
            {{-- Content --}}
            @yield('content')
        </div>

        <div class="clearfix"></div>
    </div>

    {{-- script --}}
    @stack('before-script')
    @include('includes.script')
    @include('sweetalert::alert')
    @stack('after-script')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function hapusProduk(id) {
        var idDel = "deleteForm" + id
        swal.fire({
            title: 'Hapus?',
            text: 'Data tidak akan bisa dikembalikan setelah menghapus, yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
            document.getElementById(idDel).submit();
        }
            });
        }

    </script>

<script>
    function hapusTrans(id) {
    var idDel = "deleteTrans" + id
    swal.fire({
        title: 'Hapus?',
        text: 'Data tidak akan bisa dikembalikan setelah menghapus, yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
        document.getElementById(idDel).submit();
    }
        });
    }

</script>

<script>
    function hapusPhoto(id) {
    var idDel = "deletePhoto" + id
    swal.fire({
        title: 'Hapus?',
        text: 'Data tidak akan bisa dikembalikan setelah menghapus, yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
        document.getElementById(idDel).submit();
    }
        });
    }
</script>

<script>
    function hapusCategory(id) {
    var idDel = "deleteCategory" + id
    swal.fire({
        title: 'Hapus?',
        text: 'Data tidak akan bisa dikembalikan setelah menghapus, yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
        document.getElementById(idDel).submit();
    }
        });
    }
</script>

</body>

</html>
