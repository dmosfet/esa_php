<?php csrf()->form(); ?>
<fieldset>
<label for="Firstname">FirstName</label>
<input type="text" name="FirstName" id="FirstName" value="{{ $employee->FirstName }}">
<label for="LastName">LastName</label>
<input type="text" name="LastName" id="LastName" value="{{ $employee->LastName }}">
<label for="Title">Title</label>
<input type="text" name="Title" id="Title" value="{{ $employee->Title }}">
<label for="Birthdate">Birthdate</label>
<input type="date" name="BirthDate" id="BirthDate" value="{{ $employee->BirthDate }}">
<label for="Country">Country</label>
<input type="text" name="Country" id="Country" value="{{ $employee->Country }}">
</fieldset>
