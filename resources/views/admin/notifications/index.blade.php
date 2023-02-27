@php
  /** @var $posts \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
  Notifications
@endsection
@section('content')
  <div class="row mb-3">
    <div class="col">
      <h2>Notifications List</h2>
    </div>
    <div class="col">
      <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary float-end"><i class="fa fa-plus"></i>
        Add Notification</a>
    </div>
  </div>
  <table class="table table-hover">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Age</th>
      <th>Height (Cm)</th>
      <th>Weight (Kg)</th>
      <th>Country</th>
      <th>Continent</th>
      <th>Actions</th>
    </tr>
    @foreach($notifications as $key => $notification)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $notification->getName() }}</td>
        <td>{{ $notification->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</td>
        <td>{{ $notification->getMinAge() . '-' . $notification->getMaxAge() }}</td>
        <td>{{ $notification->getMinHeight() . '-' . $notification->getMaxHeight() }}</td>
        <td>{{ $notification->getMinWeight() . '-' . $notification->getMaxWeight() }}</td>
        <td>
          <ul>
            @foreach($notification->getCountryCodeArr() as $code)
              <li>{{ $code }}</li>
            @endforeach
          </ul>
        </td>
        <td>{{ $notification->getContinentCode() }}</td>
        <td>
          <a
            href="{{ route('admin.applications.index', ['min_age' => $notification->getMinAge(), 'max_age' => $notification->getMaxAge(), 'min_height' => $notification->getMinHeight(), 'max_height' => $notification->getMaxHeight(), 'min_weight' => $notification->getMinWeight(), 'max_weight' => $notification->getMaxWeight(), 'gender' => $notification->getGender(), 'country' => $notification->getCountryCode()]) }}"
            class="btn btn-sm btn-info"><i class="fa fa-search me-1"></i>Search</a>
          <a href="{{ route('admin.notifications.edit', ['notification' => $notification]) }}"
             class="btn btn-sm btn-secondary"><i class="fa fa-pencil me-1"></i>Edit</a>
          <form class="d-inline-block"
                action="{{ route('admin.notifications.delete', ['notification' => $notification]) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger"><i class="fa fa-trash me-1"></i> Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
@endsection