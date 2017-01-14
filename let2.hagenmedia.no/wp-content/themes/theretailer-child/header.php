<?php
global $woo_options;
global $woocommerce;
global $theretailer_theme_options;

set_time_limit(0);
/*
if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163'){
	$parentArr[0] = "3233;Alfa Romeo";
$childArr[0] = "2000083;145|7176;147|7348;155|3730;156|8169;159|3243;164|3729;166|3236;33|2000289;4C|3235;75|3244;90|3241;Alfasud|3240;Alfetta|8251;Brera|3785;Giulietta|2000147;Giulietta (gml. type)|8082;GT|3239;GTV|2000094;MiTo|3238;Spider|3237;Sprint|3234;Andre";
                $parentArr[1] = "6733;Aston Martin";
$childArr[1] = "2000262;Cygnet|8318;DB7|8319;DB9|2000257;Rapide|8320;V8 Vantage|8321;Vanquish|7107;Andre";
                
                $parentArr[2] = "744;Audi";
$childArr[2] = "2000166;A1|6720;A2|2046;A3|839;A4|2000140;A4 allroad|8314;A5|840;A6|6736;A6 allroad|2000174;A7|841;A8|2000190;Q3|2000097;Q5|8149;Q7|8340;R8|7947;RS2|2000184;RS3|6721;RS4|2000185;RS5|7709;RS6|2000291;RS7|7557;S2|3731;S3|2891;S4|2000082;S5|843;S6|2000246;S7|3786;S8|3732;TT|8313;V8|835;50|836;60|837;80|838;90|833;100|834;200|2053;Andre";
                
                $parentArr[3] = "8076;Austin";
$childArr[3] = "2000180;Andre|2000127;Healey 3000";
                
                $parentArr[4] = "7166;Bentley";
$childArr[4] = "7168;Continental|7167;Mulsanne|7169;Andre";
                
                $parentArr[5] = "749;BMW";
$childArr[5] = "7967;1-serie|2000204;1M|2000283;2-serie|2132;3-serie|2000265;4-serie|2131;5-serie|3004;6-serie|2130;7-serie|2129;8-serie|2000264;i3|893;M3|2133;M5|8288;M6|2000133;X1|7798;X3|2000294;X4|6737;X5|2000085;X6|2000034;Z1|3003;Z3|7683;Z4|6716;Z8|862;1500|863;1502|864;1600|865;1602|866;1800|867;2000|868;2002|869;2500|870;2800|2058;Andre";
                
                $parentArr[6] = "8066;Buddy";
$childArr[6] = "2000141;Basic|2000120;Citi-Jet 6|2000086;Classic Basis|2000088;Classic Cab|2000087;Classic Pluss|2000143;Pluss|2000144;Premium";
                
                $parentArr[7] = "750;Buick";
$childArr[7] = "1488;Centurion|894;Century|895;Le Sabre|896;Park Avenue|897;Regal|898;Skylark|2059;Andre";
                
                $parentArr[8] = "752;Cadillac";
$childArr[8] = "979;BLS|7987;CTS|900;Deville|2000168;Eldorado|7670;Escalade|3787;Seville|7988;SRX|2000103;XLR|2061;Andre";
                
                $parentArr[9] = "753;Chevrolet";
$childArr[9] = "3736;Alero|901;Astro|7539;Avalanche|2000098;Aveo|902;Beauville|903;Beretta|7624;Big Dooley|904;Blazer|2000263;C-10|905;Camaro|907;Caprice|1486;Captiva|2000053;Cargovan|3864;Chevelle|3828;Colorado|911;Corsica|912;Corvette|7541;Crew Cab|2000233;Cruze|3862;El Camino|2000044;Epica|2000287;Express|7329;Extended Cab|3860;Impala|8094;Kalos|8113;Korea|8095;Lacetti|3005;Lumina|913;Malibu|8093;Matiz|914;Monte Carlo|8096;Nubira|2000225;Orlando|7542;Regular Cab|3733;S-10|7540;Silverado|2000179;Spark|915;Sport Van|916;Starcraft|917;Suburban|4338;Tahoe|7543;Trailblazer|3734;Trans Sport|2000254;Trax|7330;Van|2000182;Volt|2062;Andre";
                
                $parentArr[10] = "754;Chrysler";
$childArr[10] = "7174;300 M|7945;300C|7900;Crossfire|918;Grand Voyager|920;Le Baron|921;Neon|922;New Yorker|7946;Pacifica|923;Plymouth Premier|924;Plymouth Volare|7622;Prowler|6738;PT Cruiser|7173;Sebring|926;Stratus|927;Vision|928;Voyager|2063;Andre";
                
                $parentArr[11] = "757;Citroen";
$childArr[11] = "937;2CV|939;AX|3255;Berlingo|7768;Berlingo Electrique|940;BX|8339;C-Crosser|2000187;C-Zero|8237;C1|7793;C2|7521;C3|2000116;C3 Picasso|7986;C4|2000211;C4 Aircross|2000292;C4 Cactus|1492;C4 Picasso|7115;C5|8203;C6|7660;C8|943;CX|2000154;DS3|2000195;DS4|2000207;DS5|3010;Evasion|2000080;Grand C4 Picasso|947;GSA|950;Jumper|7517;Jumpy|2000156;Nemo|3012;Saxo|7538;SAXO Electrique|952;Visa|953;Xantia|954;XM|3011;Xsara|7861;Xsara Picasso|955;ZX|2066;Andre";
                
                $parentArr[12] = "8079;Dacia";
$childArr[12] = "2000191;Duster|2000245;Andre";
                
                $parentArr[13] = "760;Daewoo";
$childArr[13] = "964;Espero|7991;Kalos|7760;Koranda|7990;Lacetti|3207;Lanos|3791;Leganza|3790;Matiz|3789;Musso|965;Nexia|3206;Nubira|6751;Tacuma|2069;Andre";
                
                $parentArr[14] = "762;Daihatsu";
$childArr[14] = "6715;Applause|973;Charade|2000158;Copen|3793;Cuore|3792;Gran Move|975;Rocky|3794;Sirion|3795;Terios|7183;YRV|2071;Andre";
                
                $parentArr[15] = "8069;De Tomaso";
$childArr[15] = "2000107;Andre|2000106;Pantera";
                
                $parentArr[16] = "8085;DeLorean";
$childArr[16] = "2000273;DMC-12";
                
                $parentArr[17] = "764;Dodge";
$childArr[17] = "2000095;Avenger|1494;Caliber|2074;Challenger|2077;Charger|1001;Dakota|3796;Durango|1004;Grand Caravan|2000089;Journey|1006;Le Baron|7982;Magnum|2000163;Nitro|3797;RAM|8283;RAM SRT-10|7860;Viper|2073;Andre";
                
                $parentArr[18] = "2999;Ferrari";
$childArr[18] = "2000122;308|7165;328|7162;348|3801;355|3800;360|7164;365|2000123;412|8330;430|3799;456|2000148;458 Italia|7345;512|3798;550 Maranello|2000153;599|8307;612|2000151;California|7944;Dino|8100;F 40|2000199;FF|7163;Testarossa|3017;Andre";
                
                $parentArr[19] = "766;Fiat";
$childArr[19] = "2000071;500|2000241;500L|2881;Barchetta|1029;Bertone|2882;Brava|3225;Bravo|3802;Coupe|1030;Croma|200036;Doblo|1031;Ducato|2000201;Freemont|8325;Grande Punto|3256;Marea|2000037;Multipla|1033;Panda|1034;Punto|2000221;Punto Evo|1035;Regata|1036;Ritmo|8323;Scudo|8324;Sedici|7465;Stilo|2000063;Strada|1039;Tipo|8170;Ulysse|1040;Uno|1041;X 1/9|2075;Andre";
                
                $parentArr[20] = "8073;Fisker";
$childArr[20] = "2000115;Karma|2000135;Karma S";
                
                $parentArr[21] = "767;Ford";
$childArr[21] = "2851;Aerostar|2000232;B-MAX|2850;Bronco|7995;C-Max|3738;Cougar|1050;Courier|7326;Custom Line|2849;Econoline|1051;Escort|7109;Excursion|7512;Expedition|2848;Explorer|7328;Extended Cab|7160;F-serie|1052;Fiesta|3739;Focus|2000076;Focus CC|7600;Fusion|1053;Galaxy|1054;Granada|2000218;Grand C-MAX|3020;Ka|2000084;Kuga|8101;Maverick|1055;Mondeo|1056;Mustang|1057;Orion|2855;Probe|3257;Puma|2854;Ranger|1065;S-MAX|1059;Scorpio|1060;Sierra|7794;Sportka|8268;SVT Lightning|1061;Taunus|2853;Taurus|2852;Thunderbird|2000290;Tourneo Connect|2000272;Tourneo Custom|1063;Transit|8191;Transit Connect|2000266;Transit Custom|7327;Van|7535;Windstar|2076;Andre";
                
                $parentArr[22] = "7547;GMC";
$childArr[22] = "7549;Crew Cab|7872;Envoy|7550;Extended Cab|2000251;Sierra|7548;Silverado|2000286;Syclone|7551;Yukon|7556;Andre";
                
                $parentArr[23] = "771;Honda";
$childArr[23] = "1087;Accord|1088;Civic|3027;CR-V|2000167;CR-Z|2000039;CRX|8089;Element|8088;FR-V|3744;HR-V|2000117;Insight|2000014;Integra|7514;Jazz|1090;Legend|1091;Nsx|2000075;Odyssey|1092;Prelude|1093;Quintet|8097;Ridgeline|3803;S2000|1094;Shuttle|2000040;Stream|2080;Andre";
                
                $parentArr[24] = "7672;Hummer";
$childArr[24] = "7673;Andre|7674;H1|7675;H2|8180;H3|2000244;HX";
                
                $parentArr[25] = "772;Hyundai";
$childArr[25] = "1095;Accent|3746;Atos|3804;Coupe|1096;Elantra|7184;Galloper|7588;Getz|2899;H-1|7108;H-100|2000091;i10|2000102;i20|2000069;i30|2000194;i40|2000171;ix20|2000157;ix35|2000132;ix55|7178;Matrix|2900;Pony|6739;Santa Fe|1097;Sonata|7246;Terracan|6740;Trajet|7951;Tucson|2000193;Veloster|2000155;X35|3805;XG|2081;Andre";
                
                $parentArr[26] = "8065;Infiniti";
$childArr[26] = "2000060;Andre|2000054;FX35|2000055;FX45|2000056;G35|2000057;M35|2000058;M45|2000059;QX56";
                
                $parentArr[27] = "7179;Isuzu";
$childArr[27] = "2000077;D-max|7180;Trooper|7181;Andre";
                
                $parentArr[28] = "7280;Iveco";
$childArr[28] = "7580;3510|7294;Daily|7296;Andre";
                
                $parentArr[29] = "775;Jaguar";
$childArr[29] = "2000124;E-TYPE|2000252;F-TYPE|3747;S-TYPE|2000042;X-TYPE|8317;XF|3806;XJ|1112;XJS|3035;XK|2084;Andre";
                
                $parentArr[30] = "776;Jeep";
$childArr[30] = "1113;Cherokee|1114;Comanche|1496;Commander|8315;Compass|2143;Grand Cherokee|1115;J 20|8316;Patriot|1116;Wrangler|2085;Andre";
                
                $parentArr[31] = "774;Jensen";
$childArr[31] = "8287;Andre|8286;Interceptor";
                
                $parentArr[32] = "7764;Kewet";
$childArr[32] = "8188;Buddy|7766;City-Jet 5|7765;El-Jet|7778;Andre";
                
                $parentArr[33] = "777;Kia";
$childArr[33] = "1117;Besta|7566;Carens|6741;Carnival|2000064;Cee'd|8179;Cerato|3810;Clarus|3037;Credos|7324;Magentis|2000223;Optima|8178;Picanto|3809;Pregio|3038;Pride|7117;Rio|1118;Sephia|3808;Shuma|7711;Sorento|1119;Sportage|2000164;Venga|2086;Andre";
                
                $parentArr[34] = "8081;Koenigsegg";
$childArr[34] = "2000202;CCR";
                
                $parentArr[35] = "779;Lada";
$childArr[35] = "1121;1200|1122;1300|1123;1500|1124;1600|1125;Niva|1126;Samara|2088;Andre";
                
                $parentArr[36] = "6731;Lamborghini";
$childArr[36] = "2000222;Aventador|6732;Countach|7879;Diablo|2000112;Gallardo|2000125;LM|7218;Andre";
                
                $parentArr[37] = "780;Lancia";
$childArr[37] = "1129;A112|1130;Delta|3811;Kappa|8326;Lybra|2000050;Musa|2000051;Phedra|1131;Prisma|1132;Thema|2000052;Thesis|1133;Y10|2000049;Ypsilon|2089;Andre";
                
                $parentArr[38] = "781;Land Rover";
$childArr[38] = "6742;Defender|1135;Discovery|3750;Freelander|1136;Range Rover|2000197;Range Rover Evoque|8265;Range Rover Sport|2090;Andre";
                
                $parentArr[39] = "782;Lexus";
$childArr[39] = "2000186;CT200h|3040;GS|3812;IS|1137;LS|7949;RX300|2000070;RX400h|2000149;RX450h|7189;SC|2091;Andre";
                
                $parentArr[40] = "7153;Lincoln";
$childArr[40] = "7152;Town Car|7154;Andre";
                
                $parentArr[41] = "7191;Lotus";
$childArr[41] = "7195;Elise|2000114;Europa S|2000136;Evora|2000113;Exige|7194;Seven|7196;Andre";
                
                $parentArr[42] = "3001;Maserati";
$childArr[42] = "7118;222|3814;3200|7124;3500|7123;Biturbo|7712;Coupe|7120;Ghibli|2000256;GranTurismo|7121;Indy|7122;Mistral|7581;Quattroporte|7119;Quattroporte Evoluzzione|7325;Spyder|3041;Andre";
                
                $parentArr[43] = "8070;Matra";
$childArr[43] = "2000110;Andre|2000109;Bagheera|2000108;Murena";
                
                $parentArr[44] = "8082;Maybach";
$childArr[44] = "2000203;57";
                
                $parentArr[45] = "784;Mazda";
$childArr[45] = "1141;121|8063;2|7795;3|1145;323|8147;5|7513;6|1147;626|1149;929|8238;B 2500 Freestyle Cab|8122;B2000|1150;B2200|1151;B2600|2000068;BT-50|2000214;CX-5|2000152;CX-7|3751;Demio|1152;E2000|3815;MPV|1154;MX-3|1155;MX-5|3816;Premacy|1157;RX-2|1158;RX-7|7797;RX-8|7114;Tribute|1159;Xedos|2093;Andre";
                
                $parentArr[46] = "785;Mercedes-Benz";
$childArr[46] = "8112;190|3777;A-Klasse|8111;B-Klasse|3776;C-Klasse|2000230;Citan|7112;CL|2000250;CLA|2000100;CLC|6713;CLK|7960;CLS|3775;E-Klasse|2259;Geländewagen|8289;GL|2000285;GLA|2000096;GLK|3774;M-Klasse|8121;R-Klasse|3773;S-Klasse|7113;SL|6712;SLK|987;SLR|2000177;SLS|1187;Sprinter|3772;V-Klasse|7601;Vaneo|7871;Viano|2897;Vito|2094;Andre";
                
                $parentArr[47] = "7554;Mercury";
$childArr[47] = "7555;Andre";
                
                $parentArr[48] = "786;MG";
$childArr[48] = "3817;MG-F|7876;TF|7877;ZT|2095;Andre";
                
                $parentArr[49] = "8083;mia electric";
$childArr[49] = "2000215;mia|2000216;mia L|2000217;mia U";
                
                $parentArr[50] = "7147;MINI";
$childArr[50] = "2000270;3-dørs|2000271;Cabrio|2000105;Clubman|7150;Cooper|2000043;Cooper S|2000173;Countryman|2000236;Coupe|7149;One|2000247;Paceman|2000237;Roadster|7151;Andre";
                
                $parentArr[51] = "787;Mitsubishi";
$childArr[51] = "7155;3000 gt|2000165;ASX|1190;Carisma|1191;Colt|1193;Eclipse|1194;Galant|7994;Grandis|2000181;i-Miev|1195;L200|1196;L300|3046;L400|1197;Lancer|7713;Outlander|1198;Pajero|7992;Pajero Pinin|7953;Pajero Sport|1199;Sapporo|1200;Sigma|8144;Space Gear|7185;Space Runner|3752;Space Star|2000239;Space Star I|1201;Space Wagon|2096;Andre";
                
                $parentArr[52] = "788;Morgan";
$childArr[52] = "2000258;3-wheeler|7762;4/4|7761;Aero 8|3049;Plus 4|1204;Plus 8|3866;Roadster|2097;Andre";
                
                $parentArr[53] = "789;Morris";
$childArr[53] = "1209;Mini|2098;Andre";
                
                $parentArr[54] = "792;Nissan";
$childArr[54] = "1214;100 NX|1215;200 SX|1216;300 ZX|7950;350 Z|1217;Almera|1218;Bluebird|1219;Cherry|2000200;GT-R|7984;Interstar|2000175;Juke|1220;King Cab|8163;King Van|7983;Kubistar|1221;Laurel|2000183;Leaf|1222;Maxima|1223;Micra|2000046;Murano|8234;Navara|6753;Note|2000260;NP300|2000162;NV200|2000234;NV400|7985;Pathfinder|1224;Patrol|2000161;Pixo|1225;Prairie|7685;Primastar|1226;Primera|2000061;Qashqai|2000160;Qashqai +2|1227;Serena|8142;Skyline|1229;Stanza|1230;Sunny|1231;Terrano|7595;Tino|7188;X-Trail|2101;Andre";
                
                $parentArr[55] = "794;Oldsmobile";
$childArr[55] = "1237;Custom|1238;Cutlass|1239;Delta|1240;Omega|2103;Andre";
                
                $parentArr[56] = "795;Opel";
$childArr[56] = "2000248;ADAM|6750;Agila|2000205;Ampera|2000065;Antara|1246;Ascona|1247;Astra|1248;Calibra|1249;Campo|1252;Combo|1253;Commodore|1254;Corsa|1255;Frontera|2000081;GT|2000099;Insignia|2000288;Insignia Country Tourer|1259;Kadett|1261;Manta|7715;Meriva|2000226;Mokka|2144;Monterey|1262;Monza|7186;Movano|1264;Omega|1265;Rekord|1266;Senator|7796;Signum|3250;Sintra|7187;Speedster|1267;Tigra|1268;Vectra|7623;Vivaro|3753;Zafira|2000274;Zafira Tourer|2104;Andre";
                
                $parentArr[57] = "8077;Packard";
$childArr[57] = "2000126;Clipper|2000249;Andre";
                
                $parentArr[58] = "796;Peugeot";
$childArr[58] = "8120;1007|1270;106|8246;106 Electric|8293;107|2000259;2008|1272;205|3755;206|7586;206 CC|7585;206 SW|8294;207|2000073;207 SW|2000212;208|2000131;3008|1274;305|1275;306|7138;307|7993;307 CC|7716;307 SW|2000079;308|2000101;308 SW|1276;309|2000074;4007|2000213;4008|1279;405|1280;406|7958;407|2000139;5008|1282;505|2000188;508|1284;605|6714;607|3051;806|7634;807|1285;Boxer|7621;Expert|2000189;iOn|3754;Partner|7767;Partner Electric|2000169;RCZ|2105;Andre";
                
                $parentArr[59] = "8084;Piaggio";
$childArr[59] = "2000219;Porter|2000220;Porter Maxxi";
                
                $parentArr[60] = "797;Plymouth";
$childArr[60] = "1290;Grand Voyager|1291;Voyager|2106;Andre";
                
                $parentArr[61] = "800;Pontiac";
$childArr[61] = "1294;Bonneville|1295;Fiero|1296;Firebird|2000293;Solstice|1299;Trans Am|1300;Trans Sport|2109;Andre";
                
                $parentArr[62] = "801;Porsche";
$childArr[62] = "7237;356|1301;911|7347;914|1302;924|7342;928|1303;944|7239;968|3756;Boxster|2000275;Carrera GT|7714;Cayenne|2000067;Cayman|2000276;Macan|2000121;Panamera|2110;Andre";
                
                $parentArr[63] = "804;Renault";
$childArr[63] = "1309;12|1310;14|1311;15|1312;16|1313;17|1314;18|1315;19|1316;20|1317;30|1319;5|7850;Avantime|7544;C3|2000268;Captur|1322;Clio|7878;Clio Electrique|1324;Espace|7241;Express|1326;Fuego|7648;Grand Espace|8172;Grand Scenic|3820;Kangoo|7769;Kangoo Electric|1328;Laguna|7455;Master|1331;Megane|2000078;Megane CC|8171;Modus|3956;Scenic|1332;Trafic|7782;Twingo|2000243;Twizy|2113;Andre";
                
                $parentArr[64] = "8072;Reva";
$childArr[64] = "2000119;Andre";
                
                $parentArr[65] = "7170;Rolls Royce";
$childArr[65] = "7171;Silver Shadow|7172;Andre";
                
                $parentArr[66] = "805;Rover";
$childArr[66] = "3054;200-serie|1333;400-serie|1335;600-serie|2000028;800-serie|7684;Defender|2000255;Mini|6744;25|6745;45|3821;75|2114;Andre";
                
                $parentArr[67] = "806;Saab";
$childArr[67] = "3224;9-3|3057;9-5|1339;900|1340;9000|1341;99|2115;Andre";
                
                $parentArr[68] = "8064;Santana";
$childArr[68] = "8065;PS10|8066;Andre";
                
                $parentArr[69] = "822;Scion";
$childArr[69] = "985;tC|981;xA|983;xB";
                
                $parentArr[70] = "807;Seat";
$childArr[70] = "3825;Alhambra|7948;Altea|3824;Arosa|1345;Cordoba|7175;Cordoba Vario|1346;Ibiza|7110;Inca|6746;Leon|1347;Toledo|2116;Andre";
                
                $parentArr[71] = "808;Skoda";
$childArr[71] = "2000224;Citigo|6747;Fabia|1353;Favorit|1354;Felicia|1355;Octavia|2000242;Rapid|1490;Roomster|7532;Superb|2000128;Yeti|2117;Andre";
                
                $parentArr[72] = "7137;Smart";
$childArr[72] = "1482;Crossblade|8190;Forfour|8189;Fortwo cabrio|1484;Fortwo coupe|7956;Roadster|7957;Roadster coupe|7144;Andre";
                
                $parentArr[73] = "7190;Ssangyong";
$childArr[73] = "8302;Actyon Sport|2000145;Family|7510;Korando|8301;Kyron|7192;Musso|7511;Rexton|8173;Rodius|7193;Andre";
                
                $parentArr[74] = "810;Subaru";
$childArr[74] = "2000047;B9 Tribeca|2000228;BRZ|3067;Domingo|3655;Forester|1368;Impreza|1369;Justy|7676;L-serie|1370;Legacy|7141;Outback|2000196;Trezia|2000206;XV|2119;Andre";
                
                $parentArr[75] = "811;Suzuki";
$childArr[75] = "1372;Alto|1373;Baleno|3757;Grand Vitara|6748;Ignis|7142;Jimny|2000146;Kizashi|7177;Liana|1376;SJ|2000159;Splash|1377;Swift|8269;SX4|2000284;SX4 S-Cross|1378;Vitara|3826;Wagon R+|8081;XL7|2120;Andre";
                
                $parentArr[76] = "8080;Tazzari";
$childArr[76] = "2000192;Zero";
                
                $parentArr[77] = "8078;Tesla";
$childArr[77] = "2000138;Model S|2000137;Roadster";
                
                $parentArr[78] = "6734;Think";
$childArr[78] = "7139;City|7140;Andre";
                
                $parentArr[79] = "813;Toyota";
$childArr[79] = "1385;4-Runner|2000062;Auris|3252;Avensis|7537;Avensis Verso|1480;Aygo|1386;Camry|1387;Carina|1388;Celica|1389;Corolla|8110;Corolla Verso|1392;Crown|1393;Dyna|2000229;GT86|1394;HiAce|1395;HiClass|2000072;Highlander|1396;HiLux|2000104;IQ|1397;Land Cruiser|2000240;Land Cruiser V8|1398;MR2|3073;Picnic|1399;Previa|6749;Prius|2000227;Prius+ Seven|2000267;Proace|3074;RAV4|1401;Starlet|1402;Supra|1403;Tercel|8256;Tundra|2000118;Urban Cruiser|2000134;Verso|2000198;Verso-S|3759;Yaris|8109;Yaris Verso|2122;Andre";
                
                $parentArr[80] = "814;Triumph";
$childArr[80] = "8285;Andre|8284;Spitfire|2000253;TR7";
                
                $parentArr[81] = "820;TVR";
$childArr[81] = "8295;Andre";
                
                $parentArr[82] = "817;Volkswagen";
$childArr[82] = "2000170;Amarok|3761;Beetle|2781;Boble (gml. type)|3762;Bora|6709;Caddy|2000231;Caddy Maxi|1430;Caravelle|2000210;CC|1431;Corrado|2000048;Crafter|1432;Derby|8290;Eos|1433;Golf|2000261;Golf Cross|2000235;Golf Plus|1434;Jetta|1435;K 70|7650;LT|3760;Lupo|7952;Multivan|1437;Passat|2000209;Passat Alltrack|2000111;Passat CC|7591;Phaeton|1438;Polo|1440;Santana|1441;Scirocco|1442;Sharan|2000269;Taro|8329;Tiguan|7592;Touareg|7593;Touran|1444;Transporter|2000208;UP!|1445;Variant|1446;Vento|2126;Andre";
                
                $parentArr[83] = "818;Volvo";
$childArr[83] = "3767;744|2000045;C30|3763;C70|2784;S40|6718;S60|3083;S70|3769;S80|3768;S90|2783;V40|2000238;V40 Cross Country|7849;V50|2000172;V60|3077;V70|2000092;X60|2000093;XC 60|7781;XC 70|7651;XC 90|1450;142|1451;144|1452;145|1453;164|1456;240|1457;242|1458;244|1459;245|1461;264|1462;265|1463;340|1464;343|1465;345|1466;360|1467;440|1468;460|1469;480|1472;740|2826;745|1473;760|1474;780|1475;850|1476;940|1477;960|2145;Amazon|1478;Duett|1479;PV|2127;Andre";
                
                $parentArr[84] = "8086;Wiesmann";
$childArr[84] = "2000277;GT MF4|2000278;GT MF5|2000282;MF3|2000281;MF30|2000279;Roadster MF4|2000280;Roadster MF5";

echo "<pre>";
foreach ($parentArr as $key=>$value){
	$cat_name = explode(";", $value);
	
	$cat_name = $cat_name[1];
	var_dump($cat_name);
	$wc_merke = get_term_by( 'name', $cat_name, 'pa_merke' );
	//$wc_modells = get_terms( 'pa_modell' ); 
	//var_dump($wc_merke);
	//var_dump($wc_modells);
	$children = explode("|", $childArr[$key]);
	//$x = wp_insert_term("test Only", "pa_modell", array('slug' => sanitize_title("test Only" . '_' . $cat_name)));
	//var_dump($x);die();
	foreach ($children as $child){
		$child = explode(";", $child);
		$child = $child[1];
		//var_dump($child);
		
		$exist_model = get_term_by('name', $child, 'product_cat', ARRAY_A);
		//var_dump($exist_model);
		if (!$exist_model){
			//$model = wp_insert_term($child, "product_cat", array('parent' => $wc_merke->term_id));
			$model = wp_insert_term($child, "product_cat", array('slug' => sanitize_title($child . '_' . $wc_merke->name), 'parent' => $wc_merke->term_id ));
			//var_dump($model);var_dump($child);die();
		}
		
	}
		
	//var_dump($childArr[$key]);die();
}
}
*/
/*
//create categories and subcategories from brands and models
//wp_insert_term($line[$i], "pa_modell", array('parent' => $model_id));
$file = fopen('http://bil.hagenmedia.no/wp-content/themes/theretailer-child/models.csv', 'r');
$lines = array(); $k = 0;
while (($line = fgetcsv($file)) !== FALSE) {
	$s = explode("|", $line[0]);
	$lines[$k]['merke'] = $s[0];
	$lines[$k]['model'] = $s[1];
	$k++;
}
//$lines = array_unique($lines);
//echo "<pre>";var_dump($lines);die();
$i=0;
foreach ($lines as $line){
	//first create category if doesn't exist
	$exist_brand = get_term_by('name', $line['merke'], 'product_cat', ARRAY_A);
	echo "<pre>";var_dump($exist_brand);
	if (!$exist_brand){
		$exist_brand = wp_insert_term($line['merke'], "product_cat", array('parent' => NULL));
		echo "<pre>";var_dump($exist_brand);
	}
	//now create the subcategory
	$exist_model = get_term_by('name', $line['model'], 'product_cat', ARRAY_A);
	if (!$exist_model){
		wp_insert_term($line['model'], "product_cat", array('parent' => $exist_brand['term_id']));
	}
	
	//if ($i++ == 10) die();
}

//end creating categories and subcategories
*/



/**
 * create merke entries
 */
/*
$file = fopen('http://bil.hagenmedia.no/wp-content/themes/theretailer-child/models.csv', 'r');
$lines = array();
while (($line = fgetcsv($file)) !== FALSE) {
	$lines[] = $line[0];
}
$lines = array_unique($lines);
$cars = array();
foreach ($lines as $line){
	$line = explode("|", $line);
	$cars[] = $line[0];
} 
$cars = array_unique($cars);
//echo "<pre>";var_dump($cars);//die();

//*
// * bellow block creates all merke
foreach ($cars as $car){
	$exist = get_term_by('name', $car, 'pa_merke');
	if (!$exist){
	  	$model = wp_insert_term($car, "pa_merke");
	}
} 
//*/



//create models::
/*
$file = fopen('http://bil.hagenmedia.no/wp-content/themes/theretailer-child/models.csv', 'r');
$lines = array();
while (($line = fgetcsv($file)) !== FALSE) {
	$lines[] = $line[0];
}
$lines = array_unique($lines);
$cars = array(); $k = 0;
foreach ($lines as $line){
	$line = explode("|", $line);
	$cars[$k][0] = $line[1];
	$cars[$k][1] = $line[0];
	$k++;
} 
//$cars = array_unique($cars);
//echo "<pre>";var_dump($cars);die();


foreach ($cars as $car){
	$exist = get_term_by('name', $car[0], 'pa_modell');
	if (!$exist){
	  	$model = wp_insert_term($car[0], "pa_modell", array('slug' => sanitize_title($car[0] . '_' . $car[1])));
	}
} 
*/


/*
$args = array( 'post_type' => 'product', 'posts_per_page' => 100, 'orderby' => 'ID', 'order' => 'ASC');
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : 
	$loop->the_post(); 
	global $product; 
	echo "<pre>";var_dump($product->id);
	$modell = woocommerce_get_product_terms($product->id, "pa_modell");
	//echo '--'.$product->name . $product->id;echo "<pre>";var_dump($modell);
	//$x = wp_set_object_terms( $product->id, $category->name, 'pa_modell' , true);
	
	//die();
endwhile; 
wp_reset_query(); 

die('sfsgffg');
*/
 
/**
 * convert categories to models
 */
/* 
$file = fopen('http://bil.hagenmedia.no/wp-content/themes/theretailer-child/models.csv', 'r');
$lines = array();
while (($line = fgetcsv($file)) !== FALSE) {
	$lines[] = $line[0];
}
$lines = array_unique($lines);

//var_dump($lines);die();
foreach ($lines as $line){
  //$line is an array of the csv elements
  $line = explode("|", $line);
  var_dump($line);
  $exist = get_term_by('name', $line[0], 'pa_modell');
  if (!$exist){
  	$model = wp_insert_term($line[0], "pa_modell");
  }
  
  var_dump($model); 
  
  if (is_array($model)){
  	$model_id = $model['term_id'];
  } else {
  	//$model = get_term_by('name', $line[0], 'pa_modell');
	$model_id = $exist->term_id;
  }
  
  
  var_dump($model_id);
  for ($i = 1; $i<count($line); $i++){
  	//$exist = get_term_by('name', $line[$i], 'pa_modell');
	  //echo 'exist';var_dump($exist);
	  //if (!$exist){
  		$t = wp_insert_term($line[$i], "pa_modell", array('parent' => $model_id));
	  	//var_dump($t);
	  //}
  }
}
fclose($file);
die();
*/
 
/**
 * convert subcategories to sub-models
 */
/*
$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC'));
foreach($catTerms as $catTerm) : 
	//if ($catTerm->parent == 6991){
		var_dump($catTerm);
		$parent = get_term_by( 'id', $catTerm->parent, 'product_cat' );
		var_dump($parent);
		
		$models = get_terms("pa_modell");
		
		foreach ($models as $model){
			if ($model->name == $parent->name){
				$y = wp_insert_term($catTerm->name, 'pa_modell', array('parent' => $catTerm->parent));
				//var_dump($y);die();
			}
		}
		
	//}
endforeach;
*/
//done converting
//$x = wp_set_object_terms( 24098, 'Continental', 'pa_modell' , true);
//		var_dump($x); die();
		

/*				
$args = array( 'post_type' => 'product', 'posts_per_page' => 10);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : 
	$loop->the_post(); 
	$modell = woocommerce_get_product_terms($product->id, "pa_modell");
	var_dump($modell); //die();
	
	$categories = get_the_terms( $product->id, 'product_cat' );
	var_dump($categories);//die();
	
	foreach ($categories as $category){
		if ($category->name != $modell[0]->name){
			$x = wp_set_object_terms( $product->id, $category->name, 'pa_modell' , true);
			var_dump($x);
		}
	}
	die();
endwhile; 
wp_reset_query(); 
*/


/*
set_time_limit(0);
$args = array( 'post_type' => 'product', 'posts_per_page' => 100000 );
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : 
	$loop->the_post(); 
	global $product; 
	echo "<pre>";var_dump($product);echo "</pre>"; //die();
	$girkasse = woocommerce_get_product_terms($product->id, "pa_girkasse");
	$girkasse = $girkasse[0]->name;
	//var_dump(trim(str_replace("Automat", "", $girkasse)));

	
			if (stristr($girkasse, "Manuell")){
				wp_set_object_terms( $product->id, 'Manuell', 'pa_girkasse' , false);
				wp_set_object_terms( $product->id, trim(str_replace("Manuell", "", $girkasse)), 'pa_gir-betegnelse' , false);    			
    		} else if (stristr($girkasse, "Automat")){
    			wp_set_object_terms( $product->id, 'Automat', 'pa_girkasse' , false);
				$x = wp_set_object_terms( $product->id, trim(str_replace("Automat", "", $girkasse)), 'pa_gir-betegnelse' , false);
    		}
	
	$hjuldrift = woocommerce_get_product_terms($product->id, "pa_hjuldrift");
	$hjuldrift = $hjuldrift[0]->name;
	//var_dump(trim(str_replace("Bakhjulsdrift", "", $hjuldrift)));
	
			if (stristr($hjuldrift, "Forhjulsdrift")){
				wp_set_object_terms( $product->id, 'Forhjulsdrift', 'pa_hjuldrift' , false);
				wp_set_object_terms( $product->id, trim(str_replace("Forhjulsdrift", "", $hjuldrift)), 'pa_hjuldrift-beskrivelse' , false);    			
    		} else if (stristr($hjuldrift, "Firehjulsdrift")){
    			wp_set_object_terms( $product->id, 'Firehjulsdrift', 'pa_hjuldrift' , false);
				wp_set_object_terms( $product->id, trim(str_replace("Firehjulsdrift", "", $hjuldrift)), 'pa_hjuldrift-beskrivelse' , false);
    		} else if (stristr($hjuldrift, "Bakhjulsdrift")){
    			wp_set_object_terms( $product->id, 'Bakhjulsdrift', 'pa_hjuldrift' , false);
				$y = wp_set_object_terms( $product->id, trim(str_replace("Bakhjulsdrift", "", $hjuldrift)), 'pa_hjuldrift-beskrivelse' , false);

    		}
	
    //die();
	//var_dump(delete_woocommerce_term_meta($product->id, "pa_arsmodell"));
endwhile; 

wp_reset_query(); 
*/

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]--><head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- ******************************************************************** -->
<!-- ************************ Custom Favicon **************************** -->
<!-- ******************************************************************** -->

<link rel="shortcut icon" href="<?php if ($theretailer_theme_options['favicon_image']) { echo $theretailer_theme_options['favicon_image']; ?>
<?php } else { ?><?php echo get_template_directory_uri(); ?>/favicon.png<?php } ?>" />

<!-- ******************************************************************** -->
<!-- ******************** Custom Retina Favicon ************************* -->
<!-- ******************************************************************** -->

<link rel="apple-touch-icon-precomposed" href="<?php if ($theretailer_theme_options['favicon_retina']) { echo $theretailer_theme_options['favicon_retina']; ?>
<?php } else { ?><?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png<?php } ?>" />

<!-- ******************************************************************** -->
<!-- *********************** Custom Javascript ************************** -->
<!-- ******************************************************************** -->

<?php echo $theretailer_theme_options['custom_js_header']; ?>

<!-- ******************************************************************** -->
<!-- *********************** WordPress wp_head() ************************ -->
<!-- ******************************************************************** -->
	
<?php wp_head(); ?>
</head>

<!-- *********************************************************************** -->
<!-- ********************* EVERYTHING STARTS HERE ************************** -->
<!-- *********************************************************************** -->


<body <?php body_class(); ?>>
    
    <div id="global_wrapper">
        
        <?php
        if ( is_active_sidebar( 'top_banner' ) ){?>
            <div class="top_banner_wrapper">        
                <div class="container_12">
                    <?php dynamic_sidebar('top_banner'); ?>
                </div>             
            </div>

        <?php } ?>
    <?php if ( (!$theretailer_theme_options['hide_topbar']) || ($theretailer_theme_options['hide_topbar'] == 0) ) { ?>
    <div class="gbtr_tools_wrapper">
        <div class="container_12">
            <div class="grid_5">
        		<div class="gbtr_tools_info"><?php echo $theretailer_theme_options['topbar_text']; ?></div>
            </div>
            <div class="grid_7">
                <div class="gbtr_tools_search">
                    <form method="get" action="<?php echo home_url(); ?>">
                        <input class="gbtr_tools_search_inputtext" type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
                        <input class="gbtr_tools_search_inputbutton" type="submit" value="Search" />
                        <?php 
						/**
						* Check if WooCommerce is active
						**/
						if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
						?>
                        <input type="hidden" name="post_type" value="product">
                        <?php } ?>
                    </form>
                </div>
                <div class="gbtr_tools_account">
                    <ul>
                        <?php if ( has_nav_menu( 'tools' ) ) : ?>
						<?php  
						wp_nav_menu(array(
							'theme_location' => 'tools',
							'container' =>false,
							'menu_class' => '',
							'echo' => true,
							'items_wrap'      => '%3$s',
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 0,
							'fallback_cb' => false,
						));
						?>
                        <?php else: ?>
                            Define your top bar navigation.
                        <?php endif; ?>
                    </ul>
                </div>               
            </div>
        </div>
    </div>
    <?php } ?>
    
<div class="container_12">
    <div class="gbtr_header_wrapper">
        <div class="container_12 grid_8">
            <div class="grid_3">
                <a href="<?php echo home_url(); ?>" class="gbtr_logo">
                <img src="<?php if ( !$theretailer_theme_options['site_logo'] ) { ?><?php echo get_template_directory_uri(); ?>/images/logo.png
                <?php } else echo $theretailer_theme_options['site_logo']; ?>" alt="" />
                </a>
                &nbsp;
            </div>
            <div class="grid_5 push_1">
            
                <div class="menus_wrapper" <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>style="margin:0"<?php } ?>>
                    <div class="gbtr_first_menu">
                        <div class="gbtr_first_menu_inside">
                            
							<?php
								if ( in_array( 'ubermenu/ubermenu.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
							?>
                            	<ul>
                            <?php
                            	} else {
							?>
								<ul id="menu" class="sf-menu">
                            <?php
								}
							?>
                            
                                <?php if ( has_nav_menu( 'primary' ) && !is_user_logged_in()) : ?>
								<?php  
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' =>false,
                                    'menu_class' => '',
                                    'echo' => true,
                                    'items_wrap'      => '%3$s',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'depth' => 0,
                                    'fallback_cb' => false,
                                ));
                                ?>
                                <!--<li><?php wp_loginout(); ?></li>-->
                                <?php endif; ?>
                                <?php if ( has_nav_menu( 'primary' ) && is_user_logged_in()) : ?>
                                <?php  
	                            wp_nav_menu(array(
	                                'theme_location' => 'my_account',
	                                'container' =>false,
	                                'menu_class' => '',
	                                'echo' => true,
	                                'items_wrap'      => '%3$s',
	                                'before' => '',
	                                'after' => '',
	                                'link_before' => '',
	                                'link_after' => '',
	                                'depth' => 0,
	                                'fallback_cb' => false,
	                            ));
	                            ?>
                                <li>
                                <?php //wp_loginout(); 
                                $loginout = wp_loginout($_SERVER['REQUEST_URI'], false );
                                $loginout = str_replace("Log out", __('Log out', 'profilebuilder'), $loginout);
                                echo $loginout;
                                ?>
                                </li>
                                <?php endif; ?>
                            </ul>
                            <?php if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163'){
                                

                                }?>
                            <div class="clr"></div>
                        </div>
                    </div>
                    <div class="gbtr_second_menu">
                        <ul>
                            <?php if ( has_nav_menu( 'secondary' ) ) : ?>
							<?php  
                            wp_nav_menu(array(
                                'theme_location' => 'secondary',
                                'container' =>false,
                                'menu_class' => '',
                                'echo' => true,
                                'items_wrap'      => '%3$s',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 0,
                                'fallback_cb' => false,
                            ));
                            ?>
                            <?php else: ?>
                            	Define your secondary navigation.
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="mobiles_menus_wrapper">
                    <div class="gbtr_menu_mobiles">
                    <div class="gbtr_menu_mobiles_inside
                    <?php if ( ($theretailer_theme_options['catalog_mode']) && ($theretailer_theme_options['catalog_mode'] == 1) ) { ?>
                    gbtr_menu_mobiles_inside_catalog_mode
                    <?php } ?>
                    ">
                        <select>
                            <option selected><?php _e('Navigation', 'theretailer'); ?></option>
                            <?php
                            class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
                                function start_lvl(&$output, $depth){
                                  $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
                                }
                            
                                function end_lvl(&$output, $depth){
                                  $indent = str_repeat("\t", $depth); // don't output children closing tag
                                }
                            
                                function start_el(&$output, $item, $depth, $args){
                                  
								  // add spacing to the title based on the depth
                                  $item->title = str_repeat("&nbsp;", $depth * 4). " " . $item->title;
                            
                                  parent::start_el($output, $item, $depth, $args);
								  
                                  $output = str_replace("<li", "\n<option", $output);
                                  
                                  $output = str_replace('><a href=', ' value=', $output);
                                  $output = str_replace('</a></option>', '</option>', $output);
								  $output = str_replace('</option></option>', '</option>', $output);
								  $output = str_replace("</a>", "</option>\n", $output);
                                }
                            
                                function end_el(&$output, $item, $depth){
								}
                            }
                            if (!is_user_logged_in()){
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' =>false,
                                'menu_class' => '',
                                'echo' => true,
                                'items_wrap'      => '%3$s',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 0,
                                'fallback_cb' => false,
                                'walker' => new Walker_Nav_Menu_Dropdown()
                            ));
                            }
                            if (is_user_logged_in()){
                            wp_nav_menu(array(
	                                'theme_location' => 'my_account',
	                                'container' =>false,
	                                'menu_class' => '',
	                                'echo' => true,
	                                'items_wrap'      => '%3$s',
	                                'before' => '',
	                                'after' => '',
	                                'link_before' => '',
	                                'link_after' => '',
	                                'depth' => 0,
	                                'walker' => new Walker_Nav_Menu_Dropdown()
	                            ));
                            
                            }
                            wp_nav_menu(array(
                                'theme_location' => 'secondary',
                                'container' =>false,
                                'menu_class' => '',
                                'echo' => true,
                                'items_wrap'      => '%3$s',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'depth' => 0,
                                'fallback_cb' => false,
                                'walker' => new Walker_Nav_Menu_Dropdown(),
                            ));
                            
                            ?>
                            <?php 
                            if ( ! is_user_logged_in() ){
                            	echo '<option value="'.esc_url( wp_login_url() ).'">'.__('Logg inn', 'theretailer').'</option>';
                            } else {
                            	echo '<option value="'.esc_url( wp_logout_url() ).'">'.__('Logg ut', 'theretailer').'</option>';
                            }
                            ?>
                        </select>            
                    </div>
                    
                    </div>
                    
                    <?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
                    
                    <?php 
					/**
					* Check if WooCommerce is active
					**/
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					
					?>
                    
                    <!---->
                    
                    <div class="gbtr_dynamic_shopping_bag">
                
                        <div class="gbtr_little_shopping_bag_wrapper">
                            <div class="gbtr_little_shopping_bag">
                                <div class="title"><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><?php _e('Shopping Bag', 'theretailer'); ?></a></div>
                                <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo $woocommerce->cart->cart_contents_count; ?> <?php _e('item(s)', 'theretailer'); ?></span></div>
                            </div>
                            <div class="gbtr_minicart_wrapper">
                                <div class="gbtr_minicart">
                                <?php                                    
                                echo '<ul class="cart_list">';                                        
                                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                                    
                                        $_product = $cart_item['data'];                                            
                                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
                                            echo '<li class="cart_list_product">';                                                
                                                echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
                                                echo '<div class="cart_list_product_title">';
                                                    $gbtr_product_title = $_product->get_title();
                                                    //$gbtr_short_product_title = (strlen($gbtr_product_title) > 28) ? substr($gbtr_product_title, 0, 25) . '...' : $gbtr_product_title;
                                                    echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $gbtr_product_title, $_product) . '</a>';
                                                    echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'theretailer').' '.$cart_item['quantity'].'</div>';
                                                echo '</div>';
                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
                                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                                echo '<div class="clr"></div>';                                                
                                            echo '</li>';                                         
                                        endif;                                        
                                    endforeach;
                                    ?>
                                            
                                    <div class="minicart_total_checkout">                                        
                                        <?php _e('Cart subtotal', 'theretailer'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                                    </div>
                                    
                                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Shopping Bag', 'theretailer'); ?></a>   
                                    
                                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Proceed to Checkout', 'theretailer'); ?></a>
                                    
                                    <?php                                        
                                    else: echo '<li class="empty">'.__('No products in the cart.','woocommerce').'</li>'; endif;                                    
                                echo '</ul>';                                    
                                ?>                                                                        
                
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
                    
                    </div>
                    
                    <script type="text/javascript">// <![CDATA[
					jQuery(function(){
					  jQuery(".cart_list_product_title a").each(function(i){
						len=jQuery(this).text().length;
						if(len>25)
						{
						  jQuery(this).text(jQuery(this).text().substr(0,25)+'...');
						}
					  });
					});
					// ]]></script>
                    
                    <!---->
                    
                    <?php } ?>
                    
                    <?php } ?>
                    
                    <div class="clr"></div>
                
                </div>
                
                
            </div>
            
        </div>
    </div>
</div>