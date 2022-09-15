<head>
    <style>
   table { 


  border:3px solid black;
  border-collapse: collapse;}


   th { 
    width: 100px;
    height: 50px;
  border:3px solid black;
  border-collapse: collapse;
  background-color: rgb(80,80,80);
  color:white;
  font-weight: bold;
  font-size: 25px;
}



  td { 
    width: 30px;
    height: 10px;
  border:3px solid black;
  border-collapse: collapse;
  text-align: center;
  font-weight: bold;
  font-size: 40px;
}




.niedziela{
  background-color: red;
      border-collapse: collapse;
}

.redFont{
  color:red
}


.month{
  text-align:left;
  font-size: 40px;
  font-weight: bold;
  color:red;
}
.year{
  float:right;
  font-size: 35px;
  color:black;
}


div.main{
  width: 700px;
    height: 650px;
}



  </style>
</head>
<div class = "main">
<div class = "month" >
  {{$month}}
  <div class = "year"> {{$year}} </div>
</div>
<br>



<table>
    <tr>
      <th>Pn</th>
      <th>WT</th>
      <th>Śr</th>
      <th>Śr</th>
      <th>Czw</th>
      <th>So</th>
      <th class = "niedziela">N</th>
    </tr>
    

    @foreach ($grid as $key=>$g)
      @if (($loop->iteration - 1) % 7 == 0)
      <tr>
      @endif
        
        @if ($loop->iteration % 7 == 0)
        <td class = "redFont">{{$g}}</td>
        @else
        <td>{{$g}}</td>
        @endif  
        
      @if (($loop->iteration - 1) % 7 == 6)
      </tr>
      @endif
    @endforeach
    <!-- <tr>
      <td>8</td>
      <td>9</td>
      <td>10</td>
      <td>11</td>
      <td>12</td>
      <td>13</td>
      <td class = "redFont">14</td>
    </tr>
    <tr>
      <td>15</td>
      <td>16</td>
      <td>17</td>
      <td>18</td>
      <td>19</td>
      <td>20</td>
      <td class = "redFont">21</td>
    </tr>
    <tr>
      <td>22</td>
      <td>23</td>
      <td>24</td>
      <td>25</td>
      <td>26</td>
      <td>27</td>
      <td class = "redFont">28</td>
    </tr>

    <tr>
      <td>29</td>
      <td>30</td>
      <td>31</td>
      <td></td>
      <td></td>
      <td></td>
      <td class = "redFont"></td>
    </tr> -->
  </table>
</div>