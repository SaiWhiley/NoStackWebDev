function changeSearch(){
    var selected = document.getElementById("selectSearch").selectedIndex;
    document.getElementById("name").style.display = "none";
    document.getElementById("suburb").style.display = "none";
     document.getElementById("distance").style.display = "none";

switch(selected) {
    case 0:
        document.getElementById("suburb").style.display = "inline";
        break;
  case 1:
        document.getElementById("distance").style.display = "inline";
        break;
  case 2:
        document.getElementById("name").style.display = "inline";
        break;
  default:
        document.getElementById("suburb").style.display = "inline";
  }

}