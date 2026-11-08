<!DOCTYPE html>
<html>
<head>
    <style>
        #harita {
            height: 500px;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jvectormap@2.0.4/jquery-jvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jvectormap/tests/assets/jquery-jvectormap-world-mill.js"></script>
</head>
<body>
    <h1>Oyun</h1>
    <div id="harita"></div>

    <script>
        $(document).ready(function() {
            var ulkeler = [
                "Türkiye",
                "Almanya",
                "Fransa",
                // Diğer ülkeleri buraya ekleyin
            ];

            var ilkUlke = ulkeler[Math.floor(Math.random() * ulkeler.length)];
            var ikinciUlke = ulkeler[Math.floor(Math.random() * ulkeler.length)];

            function duelloSonucu(ilkUlke, ikinciUlke) {
                var sonuc = Math.round(Math.random());
  
                if (sonuc === 0) {
                    console.log(ilkUlke + " kazandı! " + ikinciUlke + " haritadan silindi ve topraklarını kaybetti.");
                    return ilkUlke;
                } else {
                    console.log(ikinciUlke + " kazandı! " + ilkUlke + " haritadan silindi ve topraklarını kaybetti.");
                    return ikinciUlke;
                }
            }
  
            while (ulkeler.length > 1) {
                var haritaOpts = {
                    map: 'world_mill',
                    backgroundColor: '#ffffff',
                    series: {
                        regions: [{
                            values: {},
                            scale: ['#55acee'],
                            normalizeFunction: 'polynomial'
                        }]
                    },
                    onRegionClick: function(event, code) {
                        event.preventDefault();
                    }
                };
  
                ulkeler.forEach(function(ulke) {
                    haritaOpts.series.regions[0].values[ulke] = 1;
                });
  
                $('#harita').empty().vectorMap(haritaOpts);
  
                var ilkUlke = ulkeler[Math.floor(Math.random() * ulkeler.length)];
                var ikinciUlke = ulkeler[Math.floor(Math.random() * ulkeler.length)];
  
                while (ilkUlke === ikinciUlke) {
                    ikinciUlke = ulkeler[Math.floor(Math.random() * ulkeler.length)];
                }
  
                var kalanUlke = duelloSonucu(ilkUlke, ikinciUlke);
  
                var index = ulkeler.indexOf(kalanUlke);
                if (index > -1) {
                    ulkeler.splice(index, 1);
                }
            }
  
            console.log("Oyun bitti! Tek kalan ülke: " + ulkeler[0]);
        });
    </script>
</body>
</html>
