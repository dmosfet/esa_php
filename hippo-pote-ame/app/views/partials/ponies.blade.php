<table>
    <tr>
        <th>Nom du Poney</th>
        <th>Tempérament</th>
        <th>Heures Max</th>
        <th>Action</th>
    </tr>
    @foreach($ponies as $pony)
        <tr>
            <td>{{ $pony->Name}}</td>
            <td>{{ $pony->Temperament->Name }}</td>
            <td>{{ $pony->MaxWorkHour }}</td>
            <td>
                <div class="actionbuttonbar">
                    <form action="{{route('ponies.details', $pony->PonyId)}}" method="get">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                        <button type="submit" class="detailsbutton">
                            <i class="fa fa-user"></i>
                        </button>
                    </form>
                    <form action="{{route('ponies.edit')}}" method="post">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                        <button type="submit" class="modifybutton"></button>
                    </form>
                    <form action="{{route('ponies.destroy')}}" method="post">
                        @php csrf()->form();  @endphp
                        <input type="hidden" name="PonyId" value="{{$pony->PonyId}}">
                        <button type="submit" class="deletebutton"></button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
</table>
