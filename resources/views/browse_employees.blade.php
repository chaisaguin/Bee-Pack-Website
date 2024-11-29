<!DOCTYPE html>
<html>
<head>
   <title>BEE PACK</title>
</head>
<body>
<h2>BEE PACK EMPLOYEE</h2>

@forelse ($employees as $employee)
  <p>
    <strong>Employee ID:</strong> {{ $employee->Employee_ID }}<br>
    <strong>Name:</strong> {{ $employee->Employee_Name }}<br>
    <strong>Contact Number:</strong> {{ $employee->Employee_ContactNumber }}<br>
    <strong>Position:</strong> {{ $employee->Position }}<br>
  </p>
@empty
    <p>No employees found.</p>
@endforelse

</body>
</html>