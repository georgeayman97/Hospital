@extends('layouts.client')

@section('content')
<div class="card-body">
    <form action="{{ route('appointment.store') }}" method="post">
        @csrf
      <div class="row">
        <div class="col-sm-6">
          <!-- select -->
          <div class="form-group">
            <label>Select Speciality</label>
            <select class="form-control" name="speciality">
                @foreach($specialities as $speciality)
              <option  value="{{$speciality->id}}">{{ $speciality->type}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Select Day</label>
                <div class='input-group date' id='datetimepicker'>
                    <input type='date' class="form-control" name="day" required>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
      </div>
      <label>Select Time</label>
      <div class="row">
        <div class="col-sm-6">
          <!-- select -->
          <div class="form-group">
          <label>Hour</label>
            <select class="form-control" name="hour" required>
                <option value="12">12 PM</option>
                <option value="13">1 PM</option>
                <option value="14">2 PM</option>
                <option value="15">3 PM</option>
                <option value="16">4 PM</option>
                <option value="17">5 PM</option>
                <option value="18">6 PM</option>
                <option value="19">7 PM</option>
                <option value="20">8 PM</option>
                <option value="21">9 PM</option>
            </select>
          </div>
        </div>
          <div class="col-sm-6">
            <!-- select -->
            <div class="form-group">
          <label>Minutes</label>
          <select class="form-control" name="minute" required>
                    @for($i = 0;$i < 60;$i++)
                    <option value="{{ $i}}">{{ $i}}</option>
                    @endfor
                </select>
            </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Create Appointment</button>
    </form>
    <br>
    <div class="card">
        <div class="card-header">
            <h3>Your Appointments</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>User</th>
                            <th>Speciality</th>
                            <th>Period</th>
                            <th>Hour</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                            <tr>
                                <td>{{$appointment->user->name}}</td>
                                <td>{{$appointment->speciality->type}}</td>
                                <td>{{   \Carbon\Carbon::createFromTimeStamp(strtotime($appointment->date_time))->diffForHumans(now(), Carbon\CarbonInterface::DIFF_ABSOLUTE)}}</td>
                                <td>{{Carbon\Carbon::parse($appointment->date_time)->format('H:i')}} PM</td>
                                <td>
                                    <ul class="list-unstyled table-controls "> 
                                        <li>
                                            <a href="{{route('appointment.edit',['appointment'=>$appointment->id])}}" >
                                                <i class="far fa-edit text-success"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-unstyled table-controls">
                                        <li>
                                            <form action="{{route('appointment.destroy',['appointment'=>$appointment->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button style="border: none; background: none;" type="submit" class="fa fa-trash text-danger"></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr> 
                            @empty
                            <tr>
                                <td class="text-center" colspan="4">No Appointments</td>
                            </tr>
                            @endforelse
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
        </div>
    </div>
  </div>


@endsection
