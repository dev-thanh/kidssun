<table id="table-ajax" class="table table-bordered table-striped table-hover">
<thead>
    <tr>
        <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
        <th width="10px">STT</th>
        @foreach ($module['table'] as $key => $item)
           <th width="{{ @$item['with'] }}">{{ $item['title'] }}</th>
        @endforeach
        <th width="100px">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>