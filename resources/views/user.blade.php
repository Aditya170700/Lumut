@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12 my-3">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                    Tambah
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($results as $result)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $result->username }}</td>
                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $result->role }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="modal fade" id="editModal{{ $result->username }}"
                                                                tabindex="-1"
                                                                aria-labelledby="editModal{{ $result->username }}Label"
                                                                aria-hidden="true" data-bs-backdrop="static"
                                                                data-bs-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="editModal{{ $result->username }}Label">
                                                                                Ubah</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('account.update', $result->username) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="username"
                                                                                                class="form-label">Username</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="username"
                                                                                                name="username"
                                                                                                value="{{ $result->username }}">
                                                                                            @error('username')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="name"
                                                                                                class="form-label">Name</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="name"
                                                                                                name="name"
                                                                                                value="{{ $result->name }}">
                                                                                            @error('name')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="role"
                                                                                                class="form-label">Role</label>
                                                                                            <select name="role"
                                                                                                id="role"
                                                                                                class="form-select">
                                                                                                <option hidden>Plih</option>
                                                                                                <option value="admin"
                                                                                                    {{ $result->role == 'admin' ? 'selected' : '' }}>
                                                                                                    Admin
                                                                                                </option>
                                                                                                <option value="author"
                                                                                                    {{ $result->role == 'author' ? 'selected' : '' }}>
                                                                                                    Author</option>
                                                                                            </select>
                                                                                            @error('role')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <label for="password"
                                                                                                class="form-label">Password</label>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                id="password"
                                                                                                name="password">
                                                                                            @error('password')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="mb-3">
                                                                                            <label
                                                                                                for="password_confirmation"
                                                                                                class="form-label">Password
                                                                                                Confirmation</label>
                                                                                            <input type="password"
                                                                                                class="form-control"
                                                                                                id="password_confirmation"
                                                                                                name="password_confirmation">
                                                                                            @error('password_confirmation')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <button
                                                                                            class="btn btn-sm btn-primary"
                                                                                            type="submit">Simpan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-sm btn-primary me-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $result->username }}">
                                                                Edit
                                                            </button>
                                                            <form
                                                                action="{{ route('account.destroy', $result->username) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-primary">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Data tidak ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="createModalLabel">Tambah</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('account.store') }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" value="{{ old('username') }}">
                                                        @error('username')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ old('name') }}">
                                                        @error('name')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="role" class="form-label">Role</label>
                                                        <select name="role" id="role" class="form-select">
                                                            <option hidden>Plih</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="author">Author</option>
                                                        </select>
                                                        @error('role')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password" value="{{ old('password') }}">
                                                        @error('password')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="password_confirmation" class="form-label">Password
                                                            Confirmation</label>
                                                        <input type="password" class="form-control"
                                                            id="password_confirmation" name="password_confirmation"
                                                            value="{{ old('password_confirmation') }}">
                                                        @error('password_confirmation')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
