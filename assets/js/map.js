
var uluru = { lat: 44.815076, lng: 20.436208};

var locations = [
 ['NK Main Store', 44.815076, 20.436208],
 ['NK Store 2', 44.801294, 20.477779],
 ['NK Store 3', 44.817548, 20.505475],
 ['NK Store 4', 44.813393, 20.428287],
 ['NK Store 5', 44.844415, 20.411594],
 ['NK Store 6', 43.856408, 19.839156],
 ['NK Store 7', 43.885940, 20.348324],
 ['NK Store 8', 43.320957986913925, 21.89572183741698],
 ['NK Store 8', 45.244739, 19.825393],
 ['NK Store 8', 46.054390, 14.504497],
 ['NK Store 8', 45.813140, 15.985101],
 ['NK Store 8', 42.436126, 19.260833]

];

function initMap() {

var map = new google.maps.Map(document.getElementById("map"), {
 zoom: 8,
 center: uluru,
});

for(i=0; i<locations.length; i++) {
  const marker = new google.maps.Marker({
   position: new google.maps.LatLng(locations[i][1], locations[i][2]),
   map: map,
   title: locations[i][0],
   icon: './assets/images/icon_01.png',
 });
}
}

//on click main location
function zoom(){
var map = new google.maps.Map(document.getElementById("map"), {
 zoom: 17,
 center: uluru,
}); 


for(i=0;i<locations.length; i++) {
   marker = new google.maps.Marker({
   position: new google.maps.LatLng(locations[i][1], locations[i][2]),
   map: map,
   title: locations[i][0],
   icon: './assets/images/icon_01.png',
 });
}

}












