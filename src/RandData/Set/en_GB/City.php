<?php

namespace RandData\Set\en_GB;

/**
 * UK city dataset
 */
class City extends \RandData\Set
{
    const VALIDATE_PATTERN = "[\w\d\s\(\)\'-]+";
    
    /**
     * Postcode of the city
     * @var string
     */
    protected $postcode;
    
    /**
     * Class constructor
     * @param string $postcode Postcode to get city from
     */
    public function __construct($postcode = "")
    {
        $this->setPostcode($postcode);
    }

    /**
     * Sets the postcode of the city
     * @param type $postcode The postcode of the city
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }
    
    /**
     * @inherit
     */
    public function get()
    {
        $cityListByPostcode = $this->getCityList();
        $cityListStr = "";
        
        if ($this->postcode) {
            $cityListStr = $this->parseDistrict($this->postcode);
        }
        
        if (!$cityListStr) {
            $cityListStr = implode(",", array_values($cityListByPostcode));
        }
        
        $cityList = explode(",", $cityListStr);
        $city = preg_replace("/\s+/", " ", $cityList[array_rand($cityList)]);
        return trim($city);
    }

    /**
     * @inherit
     */
    public function init($params = array())
    {
        if (!empty($params["postcode"])) {
            $this->setPostcode($params["postcode"]);
        }
    }

    public function parseDistrict($postcode)
    {
        $matches = [];
        $cityListStr = "";
        $cityListByPostcode = $this->getCityList();
        
        preg_match("/^([A-Za-z]{1,2})\d?/", $postcode, $matches);

        if (!empty($matches[1])) {
            if (empty($cityListByPostcode[$matches[1]])) {
                die("Doesn't exist: " . $matches[1]);
            }
            $cityListStr = $cityListByPostcode[$matches[1]];
        }
        
        return $cityListStr;
    }
    
    /**
     * Returns city list
     * @return array City list in format postcode => city1, city2, ..., cityN
     */
    protected function getCityList()
    {
        return [
            'AB' => 'Aberdeen, Aberlour, Aboyne, Alford (Aberdeenshire), Ballater, Ballindalloch, Banchory, Banff, Buckie, Ellon, Fraserburgh, Huntly, Insch, Inverurie, Keith, Laurencekirk, Macduff, Milltimber, Peterculter, Peterhead, Stonehaven, Strathdon, Turriff, Westhill',
            'AL' => 'Harpenden, Hatfield, St. Albans, Welwyn, Welwyn Garden City',
            'B' => 'Alcester, Birmingham, Bromsgrove, Cradley Heath, Halesowen, Henley-in-Arden, Oldbury, Redditch, Rowley Regis, Smethwick, Solihull, Studley, Sutton  Coldfield, Tamworth, West Bromwich',
            'BA' => 'Bath (Somerset), Bradford-on-Avon (Wiltshire), Bruton, Castle Cary, Frome, Glastonbury, Radstock, Shepton Mallet, Street, Templecombe, Trowbridge,  Warminster, Wells, Westbury, Wincanton, Yeovil',
            'BB' => 'Accrington, Barnoldswick, Blackburn, Burnley, Clitheroe, Colne, Darwen, Nelson, Rossendale',
            'BD' => 'Bingley, Bradford (West Yorkshire), Cleckheaton, Keighley, Settle, Shipley, Skipton',
            'BF' => 'BFPO',
            'BH' => 'Bournemouth, Broadstone, Christchurch, Ferndown, New Milton, Poole, Ringwood, Swanage, Verwood, Wareham, Wimborne',
            'BL' => 'Bolton, Bury',
            'BN' => 'Arundel, Brighton, Eastbourne, Hailsham, Hassocks, Henfield, Hove, Lancing, Lewes, Littlehampton, Newhaven, Peacehaven, Pevensey, Polegate,         Seaford, Shoreham-by-Sea, Steyning, Worthing',
            'BR' => 'Beckenham, Bromley, Chislehurst, Keston, Orpington, Swanley, West Wickham',
            'BS' => 'Axbridge, Banwell, Bristol, Cheddar, Clevedon, Wedmore, Weston-super-Mare, Winscombe',
            'BT' => 'Antrim, Armagh, Augher, Aughnacloy, Ballycastle, Ballyclare, Ballymena, Ballymoney, Ballynahinch, Banbridge, Bangor (County Down), Belfast, Bushmills, Caledon, Newtownards, Omagh, Portrush, Portstewart, Strabane, Carrickfergus, Castlederg, Castlewellan, Clogher, Coleraine, Cookstown, Craigavon, Crumlin, Donaghadee, Downpatrick, Dromore,    Dungannon, Enniskillen, Fivemiletown, Hillsborough, Holywood, Larne, Limavady, Lisburn, Londonderry, Maghera, Magherafelt, Newcastle (County Down),  Newry, Newtownabbey',
            'CA' => 'Alston, Appleby-in-Westmorland, Beckermet, Brampton, Carlisle, Cleator, Cleator Moor, Cockermouth, Egremont, Frizington, Holmrook, Keswick, Kirkby  Stephen, Maryport, Moor Row, Penrith, Ravenglass, Seascale, St. Bees, Whitehaven, Wigton, Workington',
            'CB' => 'Cambridge, Ely, Haverhill, Newmarket, Saffron Walden',
            'CF' => 'Aberdare, Bargoed, Barry, Bridgend, Caerphilly, Cardiff, Cowbridge, Dinas Powys, Ferndale, Hengoed, Llantwit Major, Maesteg, Merthyr Tydfil,        Mountain Ash, Penarth, Pentre, Pontyclun, Pontypridd, Porth, Porthcawl, Tonypandy, Treharris, Treorchy',
            'CH' => 'Bagillt, Birkenhead, Buckley, Chester, Deeside, Ellesmere Port (Cheshire), Flint, Holywell, Mold, Neston, Prenton, Wallasey, Wirral',
            'CM' => 'Billericay, Bishop\'s Stortford, Braintree, Brentwood, Burnham-on-Crouch (Essex), Chelmsford, Dunmow, Epping, Harlow, Ingatestone, Maldon, Ongar,    Sawbridgeworth, Southminster, Stansted, Witham',
            'CO' => 'Bures, Clacton-on-Sea, Colchester, Frinton-on-Sea, Halstead, Harwich, Manningtree, Sudbury, Walton on the Naze (Essex)',
            'CR' => 'Caterham, Coulsdon, Croydon, Kenley, Mitcham, Purley, South Croydon, Thornton Heath, Warlingham, Whyteleafe',
            'CT' => 'Birchington, Broadstairs, Canterbury, Deal, Dover, Folkestone, Herne Bay, Hythe, Margate, Ramsgate, Sandwich, Westgate-on-Sea, Whitstable',
            'CV' => 'Atherstone, Bedworth, Coventry, Kenilworth, Leamington Spa, Nuneaton, Rugby, Shipston-on-Stour, Southam, Stratford-upon-Avon, Warwick',
            'CW' => 'Congleton, Crewe, Middlewich, Nantwich, Northwich, Sandbach, Tarporley, Winsford',
            'DA' => 'Belvedere, Bexley, Bexleyheath, Dartford, Erith, Gravesend, Greenhithe, Longfield, Sidcup, Swanscombe, Welling',
            'DD' => 'Arbroath, Brechin, Carnoustie, Dundee, Forfar, Kirriemuir, Montrose, Newport-on-Tay (Fife), Tayport',
            'DE' => 'Alfreton, Ashbourne, Bakewell, Belper, Burton-on-Trent, Derby, Heanor, Ilkeston, Matlock, Ripley, Swadlincote',
            'DG' => 'Annan, Canonbie, Castle Douglas, Dalbeattie, Dumfries, Gretna, Kirkcudbright, Langholm, Lockerbie, Moffat, Newton Stewart, Sanquhar, Stranraer,     Thornhill',
            'DH' => 'Chester le Street, Consett, Durham, Houghton le Spring, Stanley',
            'DL' => 'Barnard Castle, Bedale, Bishop Auckland, Catterick Garrison, Crook, Darlington, Ferryhill, Hawes, Leyburn, Newton Aycliffe, Northallerton, Richmond (North Yorkshire), Shildon, Spennymoor',
            'DN' => 'Barnetby, Barrow-upon-Humber, Barton-upon-Humber, Brigg, Cleethorpes, Doncaster, Gainsborough, Goole, Grimsby, Immingham, Retford, Scunthorpe,      Ulceby',
            'DT' => 'Beaminster, Blandford Forum, Bridport, Dorchester, Lyme Regis, Portland, Sherborne, Sturminster Newton, Weymouth',
            'DY' => 'Bewdley, Brierley Hill, Dudley, Kidderminster, Kingswinford, Stourbridge, Stourport-on-Severn, Tipton',
            'E' => 'London',
            'EC' => 'London',
            'EH' => 'Balerno, Bathgate (West Lothian), Bo\'ness, Bonnyrigg, Broxburn, Currie, Dalkeith, Dunbar, East Linton, Edinburgh, Gorebridge, Gullane, Haddington,  Heriot, Humbie, Innerleithen, Juniper Green, Kirkliston, Kirknewton, Lasswade, Linlithgow, Livingston, Loanhead, Longniddry, Musselburgh, Newbridge, North Berwick, Pathhead, Peebles, Penicuik, Prestonpans, Rosewell, Roslin, South Queensferry, Tranent, Walkerburn, West Calder, West Linton',
            'EN' => 'Barnet, Broxbourne, Enfield, Hoddesdon, Potters Bar, Waltham Abbey, Waltham Cross',
            'EX' => 'Axminster, Barnstaple, Beaworthy, Bideford, Braunton, Bude, Budleigh Salterton, Chulmleigh, Colyton, Crediton, Cullompton, Dawlish, Exeter,         Exmouth, Holsworthy, Honiton, Ilfracombe, Lynmouth, Lynton, North Tawton, Okehampton, Ottery St. Mary, Seaton, Sidmouth, South Molton, Tiverton,     Torrington, Umberleigh, Winkleigh, Woolacombe',
            'FK' => 'Alloa, Alva, Bonnybridge, Callander, Clackmannan, Crianlarich, Denny, Dollar, Doune, Dunblane, Falkirk, Grangemouth, Killin, Larbert, Lochearnhead, Menstrie, Stirling, Tillicoultry',
            'FY' => 'Blackpool, Fleetwood, Lytham St. Annes, Poulton-le-Fylde, Thornton-Cleveleys',
            'G' => 'Alexandria, Arrochar, Clydebank, Dumbarton, Glasgow, Helensburgh',
            'GL' => 'Badminton, Berkeley, Blakeney, Cheltenham, Chipping Campden, Cinderford, Cirencester, Coleford, Drybrook, Dursley, Dymock, Fairford, Gloucester,    Lechlade, Longhope, Lydbrook, Lydney, Mitcheldean, Moreton-in-Marsh, Newent, Newnham, Ruardean, Stonehouse, Stroud, Tetbury, Tewkesbury, Westbury-on-Severn, Wotton-under-Edge',
            'GU' => 'Aldershot, Alton, Bagshot, Bordon, Camberley, Cranleigh, Farnborough, Farnham, Fleet, Godalming, Guildford, Haslemere, Hindhead, Lightwater,        Liphook, Liss, Midhurst, Petersfield, Petworth, Sandhurst, Virginia Water, Windlesham, Woking, Yateley',
            'GY' => 'Guernsey',
            'HA' => 'Edgware, Harrow, Northwood, Pinner, Ruislip, Stanmore, Wembley',
            'HD' => 'Brighouse, Holmfirth, Huddersfield',
            'HG' => 'Harrogate, Knaresborough, Ripon',
            'HP' => 'Amersham, Aylesbury, Beaconsfield, Berkhamsted, Chalfont St. Giles, Chesham, Great Missenden, Hemel Hempstead, High Wycombe, Princes Risborough,    Tring',
            'HR' => 'Bromyard, Hereford, Kington, Ledbury, Leominster, Ross-on-Wye',
            'HS' => 'Isle of Barra, Isle of Benbecula, Isle of Harris, Isle of Lewis, Isle of North Uist, Isle of Scalpay, Isle of South Uist, Stornoway',
            'HU' => 'Beverley, Brough, Cottingham, Hessle, Hornsea, Hull, North Ferriby, Withernsea',
            'HX' => 'Elland, Halifax, Hebden Bridge, Sowerby Bridge',
            'IG' => 'Barking, Buckhurst Hill, Chigwell, Ilford, Loughton, Woodford Green',
            'IM' => 'Isle of Man',
            'IP' => 'Aldeburgh, Brandon, Bury St. Edmunds, Diss, Eye, Felixstowe, Halesworth, Harleston, Ipswich, Leiston, Saxmundham, Southwold, Stowmarket, Thetford,  Woodbridge',
            'IV' => 'Achnasheen, Alness, Ardgay, Avoch, Beauly, Cromarty, Dingwall, Dornoch, Elgin, Fochabers, Forres, Fortrose, Gairloch, Garve, Invergordon,           Inverness, Isle of Skye, Kyle, Lairg, Lossiemouth, Muir of Ord, Munlochy, Nairn, Plockton, Portree, Rogart, Strathcarron, Strathpeffer, Strome       Ferry, Tain, Ullapool',
            'JE' => 'Jersey',
            'KA' => 'Ardrossan, Ayr, Beith, Cumnock, Dalry, Darvel, Galston, Girvan, Irvine, Isle of Arran, Isle of Cumbrae, Kilbirnie, Kilmarnock, Kilwinning, Largs,   Mauchline, Maybole, Newmilns, Prestwick, Saltcoats, Stevenston, Troon, West Kilbride',
            'KT' => 'Addlestone, Ashtead, Chertsey, Chessington, Cobham, East Molesey, Epsom, Esher, Kingston upon Thames, Leatherhead, New Malden, Surbiton, Tadworth,  Thames Ditton, Walton-on-Thames (Surrey), West Byfleet, West Molesey, Weybridge, Worcester Park (Surrey)',
            'KW' => 'Berriedale, Brora, Dunbeath, Forsinard, Golspie, Halkirk, Helmsdale, Kinbrace, Kirkwall, Latheron, Lybster, Orkney, Stromness, Thurso, Wick',
            'KY' => 'Anstruther, Burntisland, Cowdenbeath, Cupar, Dunfermline, Glenrothes, Inverkeithing, Kelty, Kinross, Kirkcaldy, Leven, Lochgelly, St. Andrews',
            'L' => 'Bootle, Liverpool, Ormskirk, Prescot',
            'LA' => 'Ambleside, Askam-in-Furness, Barrow-in-Furness, Broughton-in-Furness, Carnforth, Coniston, Dalton-in-Furness, Grange-over-Sands, Kendal, Kirkby-in- Furness, Lancaster, Millom, Milnthorpe, Morecambe, Sedbergh, Ulverston, Windermere',
            'LD' => 'Brecon, Builth Wells, Knighton, Llandrindod Wells, Llangammarch Wells, Llanwrtyd Wells, Presteigne, Rhayader',
            'LE' => 'Ashby-de-la-Zouch, Coalville, Hinckley, Ibstock, Leicester, Loughborough, Lutterworth, Market Harborough, Markfield, Melton Mowbray, Oakham,        Wigston',
            'LL' => 'Aberdyfi, Abergele, Amlwch, Arthog, Bala, Bangor (Gwynedd), Barmouth, Beaumaris, Betws-y-Coed, Blaenau Ffestiniog, Bodorgan, Brynteg, Caernarfon,   Cemaes Bay, Colwyn Bay, Conwy, Corwen, Criccieth, Denbigh, Dolgellau, Dolwyddelan, Dulas, Dyffryn Ardudwy, Fairbourne, Gaerwen, Garndolbenmaen,      Harlech, Holyhead, Llanbedr, Llanbedrgoch, Llandudno (Conwy), Llandudno Junction (Conwy), Llanerchymedd, Llanfairfechan, Llanfairpwllgwyngyll,       Llangefni, Llangollen, Llanrwst, Llwyngwril, Marianglas, Menai Bridge, Moelfre, Penmaenmawr, Penrhyndeudraeth, Pentraeth, Penysarn, Porthmadog, Prestatyn, Pwllheli, Rhosgoch,       Rhosneigr, Rhyl, Ruthin, St. Asaph, Talsarnau, Talybont (Gwynedd), Trefriw, Ty Croes, Tyn-y-Gongl, Tywyn, Wrexham, Y Felinheli',
            'LN' => 'Alford (Lincolnshire), Horncastle, Lincoln, Louth, Mablethorpe, Market Rasen, Woodhall Spa',
            'LS' => 'Ilkley, Leeds, Otley, Pudsey, Tadcaster, Wetherby',
            'LU' => 'Dunstable, Leighton Buzzard, Luton',
            'M' => 'Manchester, Sale, Salford',
            'ME' => 'Aylesford, Chatham, Faversham, Gillingham (Kent), Maidstone, Queenborough, Rochester, Sheerness, Sittingbourne, Snodland, West Malling',
            'MK' => 'Bedford, Buckingham, Milton Keynes, Newport Pagnell (Buckinghamshire), Olney',
            'ML' => 'Airdrie, Bellshill, Biggar, Carluke, Coatbridge, Hamilton, Lanark, Larkhall, Motherwell, Shotts, Strathaven, Wishaw',
            'N' => 'London',
            'NE' => 'Alnwick, Ashington, Bamburgh, Bedlington, Belford, Blaydon-on-Tyne, Blyth, Boldon Colliery, Chathill, Choppington, Corbridge, Cramlington, East     Boldon, Gateshead, Haltwhistle, Hebburn, Hexham, Jarrow, Morpeth, Newbiggin-by-the-Sea, Newcastle upon Tyne (Tyne and Wear), North Shields, Prudhoe, Riding Mill, Rowlands Gill, Ryton, Seahouses, South Shields, Stocksfield, Wallsend, Washington, Whitley Bay, Wooler, Wylam',
            'NG' => 'Grantham, Mansfield, Newark, Nottingham, Sleaford, Southwell, Sutton-in-Ashfield',
            'NN' => 'Brackley, Corby, Daventry, Kettering, Northampton, Rushden, Towcester, Wellingborough',
            'NP' => 'Abergavenny, Abertillery, Blackwood, Caldicot, Chepstow, Crickhowell, Cwmbran, Ebbw Vale, Monmouth, New Tredegar, Newport (Monmouthshire),          Pontypool, Tredegar, Usk',
            'NR' => 'Attleborough, Beccles, Bungay, Cromer, Dereham, Fakenham, Great Yarmouth, Holt, Lowestoft, Melton Constable, North Walsham, Norwich, Sheringham,    Walsingham, Wells-next-the-Sea, Wymondham',
            'NW' => 'London',
            'OL' => 'Ashton-under-Lyne, Bacup, Heywood, Littleborough, Oldham, Rochdale, Todmorden',
            'OX' => 'Abingdon, Bampton, Banbury, Bicester, Burford, Carterton, Chinnor, Chipping Norton, Didcot, Kidlington, Oxford, Thame, Wallingford, Wantage,        Watlington, Wheatley, Witney, Woodstock',
            'PA' => 'Appin, Bishopton, Bridge of Orchy (Argyll), Bridge of Weir (Renfrewshire), Cairndow, Campbeltown, Colintraive, Dalmally, Dunoon, Erskine, Gourock,  Greenock, Inveraray, Isle of Bute, Isle of Coll, Isle of Colonsay, Isle of Gigha, Isle of Iona, Isle of Islay, Isle of Jura, Isle of Mull, Isle of   Tiree, Johnstone, Kilmacolm, Lochgilphead, Lochwinnoch, Oban, Paisley, Port Glasgow, Renfrew, Skelmorlie, Tarbert, Taynuilt, Tighnabruaich, Wemyss   Bay',
            'PE' => 'Boston, Bourne, Chatteris, Downham Market, Hunstanton, Huntingdon, King\'s Lynn, March, Peterborough, Sandringham, Skegness, Spalding, Spilsby, St.  Ives (Huntingdonshire), St. Neots, Stamford, Swaffham, Wisbech',
            'PH' => 'Aberfeldy, Acharacle, Arisaig, Auchterarder, Aviemore, Ballachulish, Blairgowrie, Boat of Garten, Carrbridge, Corrour, Crieff, Dalwhinnie, Dunkeld, Fort Augustus, Fort William, Glenfinnan, Grantown-on-Spey, Invergarry, Isle of Canna, Isle of Eigg, Isle of Rum, Kingussie, Kinlochleven,            Lochailort, Mallaig, Nethy Bridge, Newtonmore, Perth, Pitlochry, Roy Bridge, Spean Bridge',
            'PL' => 'Bodmin, Boscastle, Callington, Calstock, Camelford, Delabole, Fowey, Gunnislake, Ivybridge, Launceston, Lifton, Liskeard, Looe, Lostwithiel,        Padstow, Par, Plymouth, Port Isaac, Saltash, St. Austell, Tavistock, Tintagel, Torpoint, Wadebridge, Yelverton',
            'PO' => 'Bembridge, Bognor Regis, Chichester, Cowes, East Cowes, Emsworth, Fareham, Freshwater, Gosport, Havant, Hayling Island, Lee-on-the-Solent, Newport  (Isle of Wight), Portsmouth, Rowland\'s Castle, Ryde, Sandown, Seaview, Shanklin, Southsea, Totland Bay, Ventnor, Waterlooville, Yarmouth',
            'PR' => 'Chorley, Leyland, Preston, Southport',
            'RG' => 'Basingstoke, Bracknell, Crowthorne, Henley-on-Thames, Hook, Hungerford, Newbury, Reading, Tadley, Thatcham, Whitchurch (Hampshire), Wokingham',
            'RH' => 'Betchworth, Billingshurst, Burgess Hill, Crawley, Dorking, East Grinstead, Forest Row, Gatwick, Godstone, Haywards Heath, Horley, Horsham,          Lingfield, Oxted, Pulborough, Redhill, Reigate',
            'RM' => 'Dagenham, Grays, Hornchurch, Purfleet, Rainham, Romford, South Ockendon, Tilbury, Upminster',
            'S' => 'Barnsley, Chesterfield, Dronfield, Hope Valley, Mexborough, Rotherham, Sheffield, Worksop',
            'SA' => 'Aberaeron, Ammanford, Boncath, Burry Port, Cardigan, Carmarthen, Clarbeston Road, Clynderwen, Crymych, Ferryside, Fishguard, Glogue, Goodwick,      Haverfordwest, Kidwelly, Kilgetty, Lampeter, Llanarth, Llandeilo, Llandovery, Llandysul, Llanelli, Llanfyrnach, Llangadog, Llanwrda, Llanybydder,    Milford Haven, Narberth, Neath, New Quay, Newcastle Emlyn (Carmarthenshire), Newport (Pembrokeshire), Pembroke, Pembroke Dock, Pencader, Port        Talbot, Saundersfoot, Swansea, Tenby,Whitland',
            'SE' => 'London',
            'SG' => 'Arlesey, Baldock, Biggleswade, Buntingford, Henlow, Hertford, Hitchin, Knebworth, Letchworth Garden City, Much Hadham, Royston, Sandy, Shefford,    Stevenage, Ware',
            'SK' => 'Alderley Edge, Buxton, Cheadle, Dukinfield, Glossop, High Peak, Hyde, Macclesfield, Stalybridge, Stockport, Wilmslow',
            'SL' => 'Ascot, Bourne End, Gerrards Cross, Iver, Maidenhead, Marlow, Slough, Windsor',
            'SM' => 'Banstead, Carshalton, Morden, Sutton, Wallington',
            'SN' => 'Calne, Chippenham, Corsham, Devizes, Faringdon, Malmesbury, Marlborough, Melksham, Pewsey, Swindon',
            'SO' => 'Alresford, Brockenhurst, Eastleigh, Lymington, Lyndhurst, Romsey, Southampton, Stockbridge, Winchester',
            'SP' => 'Andover, Fordingbridge, Gillingham (Dorset), Salisbury, Shaftesbury, Tidworth',
            'SR' => 'Peterlee, Seaham, Sunderland',
            'SS' => 'Basildon, Benfleet, Canvey Island, Hockley, Leigh-on-Sea, Rayleigh, Rochford, Southend-on-Sea, Stanford-le-Hope, Westcliff-on-Sea, Wickford',
            'ST' => 'Leek, Newcastle (Newcastle-under-Lyme, Staffordshire), Stafford, Stoke-on-Trent, Stone, Uttoxeter',
            'SW' => 'London',
            'SY' => 'Aberystwyth, Bishops Castle, Borth, Bow Street, Bucknell, Caersws, Church Stretton, Craven Arms, Ellesmere (Shropshire), Llanbrynmair, Llandinam,   Llanfechain, Llanfyllin, Llanidloes, Llanon, Llanrhystud, Llansantffraid-ym-Mechain, Llanymynech, Ludlow, Lydbury North, Machynlleth, Malpas,        Meifod, Montgomery, Newtown, Oswestry, Shrewsbury, Talybont (Ceredigion), Tregaron, Welshpool, Whitchurch (Shropshire), Ystrad Meurig',
            'TA' => 'Bridgwater, Burnham-on-Sea (Somerset), Chard, Crewkerne, Dulverton, Highbridge, Hinton St. George, Ilminster, Langport, Martock, Merriott,          Minehead, Montacute, Somerton, South Petherton, Stoke-sub-Hamdon, Taunton, Watchet, Wellington',
            'TD' => 'Berwick-upon-Tweed, Cockburnspath, Coldstream, Cornhill-on-Tweed, Duns, Earlston, Eyemouth, Galashiels, Gordon, Hawick, Jedburgh, Kelso, Lauder,    Melrose, Mindrum, Newcastleton (Roxburghshire), Selkirk',
            'TF' => 'Broseley, Market Drayton, Much Wenlock, Newport (Shropshire), Shifnal, Telford',
            'TN' => 'Ashford (Kent), Battle, Bexhill-on-Sea, Cranbrook, Crowborough, Edenbridge, Etchingham, Hartfield, Hastings, Heathfield, Mayfield, New Romney,      Robertsbridge, Romney Marsh, Rye, Sevenoaks, St. Leonards-on-Sea, Tenterden, Tonbridge, Tunbridge Wells, Uckfield, Wadhurst, Westerham, Winchelsea',
            'TQ' => 'Brixham, Buckfastleigh, Dartmouth, Kingsbridge, Newton Abbot, Paignton, Salcombe, South Brent, Teignmouth, Torquay, Totnes',
            'TR' => 'Camborne, Falmouth, Hayle, Helston, Isles of Scilly, Marazion, Newquay, Penryn, Penzance, Perranporth, Redruth, St. Agnes, St. Columb, St. Ives     (Cornwall), Truro',
            'TS' => 'Billingham, Guisborough, Hartlepool, Middlesbrough, Redcar, Saltburn-by-the-Sea, Stockton-on-Tees, Trimdon Station, Wingate, Yarm',
            'TW' => 'Ashford (Middlesex), Brentford, Egham, Feltham, Hampton, Hounslow, Isleworth, Richmond (London), Shepperton, Staines-upon-Thames, Sunbury-on-Thames, Teddington, Twickenham',
            'UB' => 'Greenford, Hayes, Northolt, Southall, Uxbridge, West Drayton',
            'W' => 'London',
            'WA' => 'Altrincham, Frodsham, Knutsford, Lymm, Newton-le-Willows, Runcorn, St. Helens, Warrington, Widnes',
            'WC' => 'London',
            'WD' => 'Abbots Langley, Borehamwood, Bushey, Kings Langley, Radlett, Rickmansworth, Watford',
            'WF' => 'Batley, Castleford, Dewsbury, Heckmondwike, Knottingley, Liversedge, Mirfield, Normanton, Ossett, Pontefract, Wakefield',
            'WN' => 'Leigh, Skelmersdale, Wigan',
            'WR' => 'Broadway, Droitwich, Evesham, Malvern, Pershore, Tenbury Wells, Worcester (Worcestershire)',
            'WS' => 'Burntwood, Cannock, Lichfield, Rugeley, Walsall, Wednesbury',
            'WV' => 'Bilston, Bridgnorth, Willenhall, Wolverhampton',
            'YO' => 'Bridlington, Driffield, Filey, Malton, Pickering, Scarborough, Selby, Thirsk, Whitby, York',
            'ZE' => 'Shetland'
        ];
    }
}
