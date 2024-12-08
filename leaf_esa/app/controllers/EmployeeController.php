<?php

namespace App\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    function index()
    {
        $titre= 'Employees';
        $employees = Employee::select('EmployeeId','Firstname','Lastname','Title', 'Birthdate', 'Country')->orderBy('CustomerId','DESC')->get();
        render('employee.index',compact('employees','titre'));
    }

    function create()
    {
        $employee = new Employee();
        render('employee.create',compact('employee'));
    }

    function store()
    {
        $data=request()->postData();
        $employee = new Employee();
        $employee->FirstName = $data['FirstName'];
        $employee->LastName = $data['LastName'];
        $employee->Title = $data['Title'];
        $employee->BirthDate = $data['BirthDate'];
        $employee->Country = $data['Country'];
        $employee->save();
        response()->redirect('/employees');
    }

    function edit(int $employeeId) {
        $employee = Employee::find($employeeId);
        render('employee.edit',compact('employee'));

    }

    function update() {
        $data=request()->postData();
        $employee = Employee::find($data['EmployeeId']);
        $employee->FirstName = $data['FirstName'];
        $employee->LastName = $data['LastName'];
        $employee->Title = $data['Title'];
        $employee->BirthDate = $data['BirthDate'];
        $employee->Country = $data['Country'];
        $employee->save();
        response()->redirect(route('employees.index'));
    }

    function destroy() {
        $data = request()->postData();
        $employee = Employee::find($data['EmployeeId']);
        $employee->delete();
        response()->redirect(route('employees.index'));
    }



}
