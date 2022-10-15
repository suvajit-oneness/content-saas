@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $user['first_name'] . ' ' . $user['last_name'] }}</td>
                        </tr>
                        <tr>
                            <td>Email Id</td>
                            <td>{{ empty($user['email']) ? null : $user['email'] }}</td>
                        </tr>
                        <tr>
                            <td>Mobile No</td>
                            <td>{{ empty($user['mobile']) ? null : $user['mobile'] }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ empty($user['address']) ? null : $user['address'] }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ empty($user['city']) ? null : $user['city'] }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ empty($user['country']) ? null : $user['country'] }}</td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.users.index') }}">Back</a>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <p>Purchased course</p>
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Course Name</th>
                                <th> Course Length </th>
                                 <th> Course Duration </th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course as $key => $data)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $data->course->course_name }}</td>
                                    <td>{{ $data->course->length }}</td>
                                     <td>{{ $data->course->duration }}</td>
                                    <td>{{ date("d-M-Y h:i a",strtotime($data->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  --}}
@endsection
