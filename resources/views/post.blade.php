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
                                                <th scope="col">Title</th>
                                                <th scope="col">Content</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Author</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($results as $result)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $result->title }}</td>
                                                    <td>{{ $result->content }}</td>
                                                    <td>{{ $result->date_f }}</td>
                                                    <td>{{ $result->author?->name }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="modal fade" id="editModal{{ $result->idpost }}"
                                                                tabindex="-1"
                                                                aria-labelledby="editModal{{ $result->idpost }}Label"
                                                                aria-hidden="true" data-bs-backdrop="static"
                                                                data-bs-keyboard="false">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="editModal{{ $result->idpost }}Label">
                                                                                Ubah</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('post.update', $result->idpost) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="title"
                                                                                                class="form-label">Title</label>
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                id="title"
                                                                                                name="title"
                                                                                                value="{{ $result->title }}">
                                                                                            @error('title')
                                                                                                <div
                                                                                                    class="form-text text-danger">
                                                                                                    {{ $message }}</div>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <div class="mb-3">
                                                                                            <label for="content"
                                                                                                class="form-label">Content</label>
                                                                                            <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ $result->content }}</textarea>
                                                                                            @error('name')
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
                                                                data-bs-target="#editModal{{ $result->idpost }}">
                                                                Edit
                                                            </button>
                                                            <form action="{{ route('post.destroy', $result->idpost) }}"
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
                                                    <td colspan="6" class="text-center">Data tidak ada</td>
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
                                        <form action="{{ route('post.store') }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" value="{{ old('title') }}">
                                                        @error('title')
                                                            <div class="form-text text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="content" class="form-label">Content</label>
                                                        <textarea name="content" id="content" cols="30" rows="3" class="form-control">{{ old('content') }}</textarea>
                                                        @error('name')
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
