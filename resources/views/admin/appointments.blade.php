@extends('layouts.admin')

@section('content')
<form>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="Type">Speciality</label>
            <select class="form-control" id="Type"  name="type" 
             title="Select">
             <option value="">Select</option>
             @foreach ($specialities as $speciality)
                 
             <option value="{{$speciality->id}}">{{$speciality->type}}</option>
             @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="Date">Date</label>
            <div class='input-group date' id='datetimepicker'>
                <input type='date' class="form-control" name="date">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
        </div>
        </div>
    </div>
    

    <div class="form-row">
        <div class="col-md-12 text-center">
            <button  type="submit" class="btn btn-success mt-3">Search</button>
            <a href="{{route('appointment.index')}}" class="btn btn-danger mt-3">Cancel</a>
        </div>
    </div>
</form>
<br>
<br>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Appointments</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th>Speciality</th>
                        <th>Period</th>
                        <th>Hour</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{$appointment->user->name}}</td>
                            <td>{{$appointment->speciality->type}}</td>
                            <td>{{   \Carbon\Carbon::createFromTimeStamp(strtotime($appointment->date_time))->diffForHumans(now(), Carbon\CarbonInterface::DIFF_ABSOLUTE)}}</td>
                            <td>{{Carbon\Carbon::parse($appointment->date_time)->format('H:i')}} PM</td>
                        </tr> 
                        @endforeach
                      
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

@endsection
