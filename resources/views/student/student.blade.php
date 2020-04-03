@extends('layouts.master')
@section('title')
    Create a Student
@endsection
@section('content')
<div class="row align-items-center">
    <div class="col-8">
        <h4 class="pt-2"><i class="fab fa-apple"></i>Create a Students</h4>
    </div>
    <div class="col-4">
        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <a type="button" class="btn btn-sm btn-dark" href="{{route('students')}}">Back</a>
        </div>
    </div>
</div>
<form>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Enroll </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Emergency Contact</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row mt-3">
                    <div class="col-md-2 form-group">
                        <label for="title">Title: </label>
                        <select name="title" id="title" class="custom-select" value="">
                            <option selected="" disabled="">Choose Title</option>
                            <option value="Mr">Mr</option> 
                            <option value="Miss">Miss</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="fullname"><span class="text-danger">*</span> Full Name: </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="" required="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="ini_name"><span class="text-danger">*</span> Name with Initials: </label>
                        <input type="text" class="form-control" id="ini_name" name="ini_name" value=""  required="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="custom-select"><span class="text-danger">*</span> Gender: </label>
                        <select name="gender" id="gender" class="custom-select" value="" required="">
                            <option selected="" disabled="">Choose Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="civil"> Civil Status: </label>
                        <select name="civil" id="civil" class="custom-select" value="" >
                            <option selected="" disabled="">Choose Status</option>
                            <option value="Single">Single</option> 
                            <option value="Married">Married</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="email"><span class="text-danger">*</span> Email: </label>
                        <div class="input-group-prepend">
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="nimal89@gmail.com" required="">
                        </div>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="nic"><span class="text-danger">*</span> NIC: </label>
                        <input type="text" class="form-control" id="nic" name="nic" max="12" min="10" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="dob"><span class="text-danger">*</span> Date of Birth: </label>
                        <input type="date" class="form-control" id="dob" name="dob" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="phone"><span class="text-danger">*</span> Phone No: </label>
                        <input type="text" class="form-control" id="phone" name="phone" maxlength="10" minlength="10" value="" placeholder="" required="">
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="address"><span class="text-danger">*</span> Address: </label>
                        <input type="textarea" class="form-control" id="address" name="address" value="" placeholder="No, Street, Hometown." required="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="zip"> ZIP-Code:</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="" >
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="district"> District: </label>
                        <select name="district" id="district" class="custom-select" >
                <option value="">Select</option>
                <option value="Ampara"> Ampara </option>
                <option value="Batticalo"> Batticalo </option>
                <option value="Trincomalee"> Trincomalee </option>
                <option value="Jaffna"> Jaffna </option>
                <option value="Vavuniya"> Vavuniya </option>
                <option value="Killinochchi"> Killinochchi  </option>
                <option value="Mullaitivu"> Mullaitivu </option>
                <option value="Mannar"> Mannar </option>
                <option value="Puttalam"> Puttalam </option>
                <option value="Kurunegala"> Kurunegala </option>
                <option value="Gampaha"> Gampaha </option>
                <option value="Colombo"> Colombo </option>
                <option value="Kalutara"> Kalutara </option>
                <option value="Anuradhapura"> Anuradhapura </option>
                <option value="Polonnaruwa"> Polonnaruwa </option>
                <option value="Matale"> Matale	 </option>
                <option value="Kandy"> Kandy </option>
                <option value="Nuwara Eliya"> Nuwara Eliya </option>
                <option value="Kegalle"> Kegalle </option>
                <option value="Ratnapura"> Ratnapura </option>
                <option value="Badulla"> Badulla </option>
                <option value="Monaragala"> Monaragala </option>
                <option value="Hambantota"> Hambantota </option>
                <option value="Matara"> Matara </option>
                <option value="Galle"> Galle </option>
            </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="ds"> Divisional Secretariat: </label>
                        <input type="text" name="ds" class="form-control" id="ds" value="" >
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="province"> Province: </label>
                        <select name="province" id="province" class="custom-select" value="" >
                <option value="">Select</option>
                <option value="1"> Northen </option>
                <option value="2"> Eastern </option>
                <option value="3"> Western </option>
                <option value="4"> Southern </option>
                <option value="5"> Central </option>
                <option value="6"> North Western </option>
                <option value="7"> Uva </option>
                <option value="8"> North Central </option>
                <option value="9"> Sabaragamuwa </option>
            </select>
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="blood"> Blood Group: </label>
                        <select name="blood" id="blood" class="custom-select" value="">
                            <option selected="" disabled=""> Blood Group </option>
                            <option value="A+">A RhD positive (A+) </option>
                            <option value="A-">A RhD negative (A-) </option>
                            <option value="B+">B RhD positive (B+) </option>
                            <option value="B-">B RhD negative (B-) </option>
                            <option value="O+">O RhD positive (O+) </option>
                            <option value="O-">O RhD negative (O-) </option>
                            <option value="AB+">AB RhD positive (AB+) </option>
                            <option value="AB-">AB RhD negative (AB-) </option> 
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="cid"><span class="text-danger">*</span> Course Name: </label>
                        <select name="cid" id="cid" class="custom-select" value="" required>
                        <option selected="" disabled=""> ........select the Course .......</option>
                          <option value="3ME">Assistant In mechanical</option><option value="4AT">Technician in Automotive Technology</option><option value="4CS">Technician In Construction Technology</option><option value="4IT">Technician In Information and Communication Technology</option><option value="5AT">National Diploma in Automotive Technology</option><option value="5CT">National Diploma in Construction Technology            </option><option value="5FT">National Diploma in Food Technology</option><option value="5IT">National Diploma in Information and Communication Technology</option><option value="5MA">National Diploma in Mechanical Technology</option><option value="5ME">National Diploma in Mechatronics Technology            </option><option value="6IT">Higher National Diploma In Information Communication &amp; technology</option><option value="BAT">Bridging In Automotive Technology</option><option value="BCT">Bridging In Construction Technology</option><option value="BIT">Bridging Information Technology</option><option value="TEST">Bridging In Construction Technology</option> 
                      </select>
                    </div>
                
                    <div class="col-md-3 form-group">
                        <label for="ayear"><span class="text-danger">*</span> Academic Year: </label>
                       <select name="ayear" id="ayear" class="custom-select" data-live-search="true" data-width="100%" value="" required="" tabindex="-98">
                      <option selected="" disabled="">--Academic Year--</option>
                      <option value="2020/2021" data-subtext="Active">2020/2021</option><option value="2018/2019" data-subtext="Completed">2018/2019</option><option value="2017/2018" data-subtext="Completed">2017/2018</option><option value="2016/2017" data-subtext="Completed">2016/2017</option> 
                      </select>
                    </div>
                
                    <div class="col-md-2 form-group">
                        <label for="mode"><span class="text-danger">*</span> Course Mode: </label>
                        <select name="mode" id="mode" class="custom-select" value="" required="">
                        <option selected="" disabled=""> Course Mode </option>
                          <option value="Full">Full Time</option> 
                          <option value="Part">Part Time</option>
                     </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="sid"><span class="text-danger">*</span> Student ID:</label>
                        <input type="text" class="form-control" name="sid" value="" id="sid" required="">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="status"><span class="text-danger">*</span> Status:</label>
                        <select name="status" id="status" class="custom-select" value="" required="">
                        <option disabled="">Choose Status</option>
                          <option selected=""  value="Following">Following</option> 
                          <option value="Completed">Completed</option>
                          <option value="Dropout">Dropout</option>
                          <option value="Long Absent">Long Absent</option>
                      </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="enrolldate"><span class="text-danger">*</span>Enroll Date:</label>
                        <input type="date" class="form-control" value="" id="enrolldate" name="enrolldate" placeholder="" aria-describedby="enrolldatePrepend" required="">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="exitdate">Exit Date:</label>
                        <input type="date" class="form-control" value="" id="exitdate" name="exitdate" >
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="Ename">Name :</label>
                        <input type="text" class="form-control" id="Ename" name="Ename" value="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="addressE">Address :</label>
                        <input type="text" class="form-control" id="addressE" name="addressE" value="" >
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="Ephone">Phone No :</label>
                        <input type="text" class="form-control" id="Ephon" maxlength="10" minlength="10" name="Ephone" value="">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="relation">Relationship :</label>
                        <select name="relation" id="relation" value="" class="custom-select">
                              <option value="">Select</option>
                              <option value="mother"> Mother </option>
                              <option value="father"> Father </option>
                              <option value="guardian"> Guardian </option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary float-right" >Save</button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection