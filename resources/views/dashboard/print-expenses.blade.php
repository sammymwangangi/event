<!DOCTYPE html>
<html>
<head>
    <title>Bookings List</title>
     <style>
    #layout {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 110px;
        caption-side: top;
    }

    #layout td, #layout th {
        border: 1px solid #ddd;
        padding: 8px;
    }


    #layout tr:hover {background-color: #ddd;}

    #layout th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color:#eceff1;
        color: #222222;
    }
 caption{
font-size: 26px;
font-weight: bold;
color:#222222;
padding: .2em .8em;
}
   /* Create 2 unequal columns that floats next to each other */
}
.column {
    float: left;
    padding: 10px;
    height: 5px; /* Should be removed. Only for demonstration */
}

.left {
  width: 35%;
}

.right {
  width: 65%;
}

/* Clear floats after the columns */
.header:after {
    content: "";
    display: table;
    clear: both;
}
    </style>
</head>
<body>
      <div class="header">
    <div class="column left"><img src="{{ public_path('/images/venue-bg.jpg') }}" style="width: 50px; height: 50px"  alt="LOGO"></div>
    <div class="column right"><h1>EVENTSS</h1>
                              <h4>P.O. BOX 0 NAIROBI</h4>
                              <h4><i>Events Management System</i></h4>
                          </div>
              </div>
              <h6>&nbsp;</h6>

<table id="layout">
    <caption>TRACKING EXPENSES</caption>
     <thead>
        <tr class="">
            <th>INCOME</th>
            <th>EXPENSES</th>
            <th>NET PROFIT</th>
        </tr>
    </thead>
    <tbody>
           
        <tr>
            <td>{{$bookings->sum('total')}}</td>
            <td>
              {{ $venue_bookings->sum('venue.price') + $service_bookings->sum('service.price') }}
            </td>
            <td>
              {{$bookings->sum('total') - ($venue_bookings->sum('venue.price') + $service_bookings->sum('service.price')) }}
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>