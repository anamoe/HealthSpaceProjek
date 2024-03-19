@extends('layouts.main')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">

        <div class="card-header bg-success-dark">
            <h6 class="card-title text-white">Poli
                <button class="btn btn-sm btn-primary float-end">Add</button>
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive text-nowrap" style="min-height:180px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Poli</th>
                            <th width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        <tr>
                            <td>1</td>
                            <td>Albert Cook</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection