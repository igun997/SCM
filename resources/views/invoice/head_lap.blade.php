<table style="width:90%">
  <tr>
    <td >
      <img src='{{public_path("assets/images/logo.png")}}' style="width:50px"/>
    </td>
    <td align="center" >
      <b style="font-size:18px">{{session()->get("nama")}}</b>
      <br>
      {{session()->get("alamat")}}
      <br>
      HP : {{session()->get("no_kontak")}} Email : {{session()->get("email")}}
    </td>
     <td>

    </td>
  </tr>
</table>
<hr/>
