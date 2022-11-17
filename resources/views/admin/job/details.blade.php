@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
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
                            <td>Title</td>
                            <td>{{ empty($Job['title'])? null:$Job['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ empty($Job->category->title)? null:($Job->category->title) }}</td>
                        </tr>
                        <tr>
                            <td>Employment Type </td>
                            <td>{{ empty($Job['employment_type'])? null:($Job['employment_type']) }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ empty($Job['address'])? null:($Job['address']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Postcode</td>
                            <td>{{ empty($Job['postcode'])? null:($Job['postcode']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ empty($Job['city'])? null:($Job['city']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ empty($Job['state'])? null:($Job['state']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ empty($Job['country'])? null:($Job['country']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Salary Per</td>
                            <td>{{ empty($Job['salary'])? null:($Job['salary']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>{{ empty($Job['payment'])? null:($Job['payment']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Skill</td>
                            <td>{{ empty($Job['skill'])? null:($Job['skill']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Experience</td>
                            <td>{{ empty($Job['experience'])? null:($Job['experience']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Scope</td>
                            <td>{{ empty($Job['scope'])? null:($Job['scope']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($Job['description'])? null:($Job['description']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Company Name</td>
                            <td>{!! empty($Job['company_name'])? null:($Job['company_name']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($Job['company_desc'])? null:($Job['company_desc']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('admin.job.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
