<?php
  $isInTrash = strpos(\Request::route()->getName(), 'trash') !== false;
  if ($isInTrash) {
      $links[] = [route(str_replace('trash','home',\Request::route()->getName()) ), $current];
  } 
?>
<ol class = "breadcrumb">
    <li><i class="fa fa-anchor"></i> <a href="{{route('backend::dashboard')}}">Dashboard</a></li>
    @foreach($links as $piece)
      <li><a href="{{$piece[0]}}">{{$piece[1]}}</a></li>
    @endforeach
    <li class="active">{{$isInTrash ? 'Thùng rác' : $current}}</li>
</ol>