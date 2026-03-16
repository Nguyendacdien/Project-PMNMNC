<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Quản lý sản phẩm</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bộ lọc</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.index') }}" method="GET" class="form-inline">
                                <div class="form-group mr-2">
                                    <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên..." value="{{ request('keyword') }}">
                                </div>
                                <div class="form-group mr-2">
                                    <select name="category_id" class="form-control">
                                        <option value="">-- Tất cả danh mục --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Lọc</button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
                                        <th>Giá KM</th>
                                        <th>Tồn kho</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                @if($item->image)
                                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" width="60">
                                                @else
                                                    <span class="text-muted">Không có</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category ? $item->category->name : 'Không có' }}</td>
                                            <td>{{ number_format($item->price) }}</td>
                                            <td>{{ $item->sale_price ? number_format($item->sale_price) : '-' }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge badge-success">Hoạt động</span>
                                                @else
                                                    <span class="badge badge-danger">Tắt</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
