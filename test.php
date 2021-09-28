<?php
// RUN: php test.php

include 'lib/LibIndyWrapper/LibIndy.php';


$libIndy = new LibIndy();
$future = $libIndy->createSchema("CsiDLAiFkQb9N4NDJKUagd", 'test', "0.1", '["name"]')->get();
var_dump($future);

//$libIndy->setDefaultLogger("trace");
putenv("HOME=/tmp"); // workaround for lib indy to load the genesis file
$configName = "idunion_test_ledger";
$config = '{"genesis_txn":"'.__DIR__.'/lib/LibIndyWrapper/genesis_txn.txt"}';
try {
    $libIndy->createPoolLedgerConfig($configName, $config)->get();
} catch (LibIndyException $e) {
    $libIndy->deletePoolLedgerConfig($configName)->get();
    $libIndy->createPoolLedgerConfig($configName, $config)->get();
}
var_dump("Pool ledger config created");

$poolHandle = $libIndy->openPoolLedger($configName)->get();
var_dump($poolHandle);

$schemaRequest = $libIndy->buildGetSchemaRequest("3QowxFtwciWceMFr7WbwnM", "did:indy:idu:test:3QowxFtwciWceMFr7WbwnM:2:BasicScheme:0.1")->get();
$schemaResponseRaw = $libIndy->submitRequest($poolHandle, $schemaRequest)->get();
$schemaResponse = $libIndy->parseGetSchemaResponse($schemaResponseRaw)->get();


$credDefRequest = $libIndy->buildGetCredDefRequest("CsiDLAiFkQb9N4NDJKUagd", "CsiDLAiFkQb9N4NDJKUagd:3:CL:4687:NextcloudPrototypeCredentialWithoutRev")->get();
$credDefResponseRaw = $libIndy->submitRequest($poolHandle, $credDefRequest)->get();
$credDefResponse = $libIndy->parseGetCredDefResponse($credDefResponseRaw)->get();

//$proof = '{"proof":{"proofs":[{"primary_proof":{"eq_proof":{"revealed_attrs":{"email":"1234","first_name":"1234","last_name":"1234"},"a_prime":"88682748240138713241608114359728562410633707121169116259462216377201230836040295545023203986208235055760604553447282865080299078853399147774598056998838671551931738557148251641658375895832662866947579580917692043101765479352445510398780751913359869353998020195518218696741963107890721528083708008510755343025125009480882245956257744861177655080327607439654210888420058185291953052393179141601103461028143328515505597825270081247644438104627015420781779446279719370140877920224560181770715848519847039537723078471460823436318125314527430863669897000784814995466078246488450882347848386306233574459840280742174553011491","e":"169589027915552415286635825379615860031542221227217563696632031229426880237136385761016734483872101421860639700410732389456802625622561048","v":"1258245165521465369534786351216329239950666881033527697523581085645185298194150523086946299045615724093534246410675293176451770984542084680109152870540733506173650392576771085221627490461459947211338010088273151473568848297729742782831720773717262291989878610816317912048983701068378693983897769643062801573033726249460806383499715258674202225062810647450335283895834964315950805129813531621981970948490755945079417994462752354221455439324167034332354080241121722835400934223955602947400389645485783833496255998794562657849163140381115004805206068454794415507752897225476201656389961086085229650138234347578109462488256861850373270807916566416172900738294859604061108372444077680013329831300963949415583771592087780469986941358655221324456485480778950270096700080575878134065224053940039529518695872163621867115462717046664600867327521262606656956213489943445185330410162586749692700263051874180695328488536197147173239312","m":{"master_secret":"5819965013655989316390585735598618354601189066859438695152319196324870406037243459678086785541987465022934192821717526238435199705534951605149382794395314394451418282879408887535"},"m2":"12209983039921503296565284886810594038399450520196381550476182393123199240879735414503998245830863220496798637194449570064485071676739973050838481341947954066095182828742488356511"},"ge_proofs":[]},"non_revoc_proof":null}],"aggregated_proof":{"c_hash":"71706334824986116140366237704002932954524077361349251929941802403753474256111","c_list":[[2,190,128,175,253,175,232,66,244,191,95,32,137,109,4,61,139,239,247,232,255,28,146,160,76,79,24,9,139,179,200,127,97,143,223,37,218,25,246,57,77,133,8,169,165,108,69,140,176,188,39,172,179,255,87,97,165,253,200,30,197,213,92,250,230,100,246,96,61,162,12,240,175,34,254,147,85,212,4,78,234,234,65,34,17,17,183,48,140,126,159,174,178,170,196,115,148,145,117,231,49,105,10,88,138,172,135,9,43,159,55,144,154,0,227,224,21,72,234,158,113,216,72,83,44,52,246,231,95,170,199,238,188,64,176,36,69,251,199,82,168,67,220,72,122,191,184,107,9,9,187,69,18,36,185,202,145,104,150,100,29,24,198,83,241,70,81,134,145,0,151,130,65,188,85,229,89,204,33,26,209,157,182,223,59,246,126,166,178,86,177,203,181,124,47,134,210,162,136,186,225,8,218,71,232,6,125,34,241,156,63,123,45,149,159,31,45,227,85,117,42,235,115,140,81,88,81,173,133,154,180,221,55,166,137,247,253,33,182,44,6,201,52,152,64,115,238,133,47,252,95,60,155,66,179,245,35]]}},"requested_proof":{"revealed_attrs":{},"revealed_attr_groups":{"ref1":{"sub_proof_index":0,"values":{"first_name":{"raw":"Alice","encoded":"1234"},"last_name":{"raw":"Wonderland","encoded":"1234"},"email":{"raw":"alice@example.com","encoded":"1234"}}}},"self_attested_attrs":{},"unrevealed_attrs":{},"predicates":{}},"identifiers":[{"schema_id":"3QowxFtwciWceMFr7WbwnM:2:BasicScheme:0.1","cred_def_id":"CsiDLAiFkQb9N4NDJKUagd:3:CL:4687:NextcloudPrototypeCredentialWithoutRev","rev_reg_id":null,"timestamp":null}]}';
$proof = '{"proof":{"proofs":[{"primary_proof":{"eq_proof":{"revealed_attrs":{"email":"115589951590854546960691112648251660507865356487762333837470597583915671017846","first_name":"27034640024117331033063128044004318218486816931520886405535659934417438781507","last_name":"16790849312374794736813377567253851373607970473377701477269194019557654562035"},"a_prime":"11190203248376322136770460609194394825731335043032090059988609373413782382324989919443243304014535117596659973041792300030999111602997399188454052852560979682517334546129821040975716796546918299410389563359181630438943732632285131073714463959048580376409731222268682605267358538800902079903611251844083842220565543987243227634287973932308006147167978169667246708828318429120260428167940832447853120323915836625516409856815231696593207993081619733004259926900714420740914632693327409953968999151689286280479521942623587691358353448136876306098478438064859732347511431396507423289389686316381953085951274022450019066727","e":"18646760530239144549831686036420971964900647185353817570181243120111584068697575209550628427039092378575413791294506725232213020189750795","v":"1340621060923572535906908503868636399434159035393296211928152579616164592359584228958063256231792416053709724839203646418313318379532378273438409471771247394785362268477815832823263229021989291048685670720082340014184730811546340435732075329370574237540450780182696995197079035750988289448161064637332530721298876286649399125561631990066466612967375203602170784812279441371925977248099343679181700369052323560623846299745019916875606131369690952749467401851716132109096032961826537858762686943821278258540984114861513048647954992580081935084634807326970355135283895830060935257277820722588512729296556240125256951082934127612199367132774108968204915014819468296573633426828912371189690184775120403107143135776915636884661760621492106175004570455160020533292608834195865616200733011517781415774522252616815552894060517917527855684733269095670303625160050140798067672036363768983440977360378197994289762779934278160836623927","m":{"master_secret":"13460071750207624998959504148566225127418535361441862900398361533846496090526121887809228446771563338178756007065304141600858188998727172995098731538900394850720886908868207407504"},"m2":"7257912178977856883889246272803480623606365728085422196996402534374189067570173616351646041909894097006815144433010624118457354574547691675128835332190846879368308776374285018305"},"ge_proofs":[]},"non_revoc_proof":null}],"aggregated_proof":{"c_hash":"56975975579983024060094632874984662739637548300809721552935023300331384746858","c_list":[[88,164,187,104,242,253,224,23,109,28,139,140,19,150,170,116,177,214,209,144,167,110,72,75,66,50,99,211,165,74,190,124,198,213,72,1,47,31,191,55,81,75,18,183,220,112,156,176,92,91,252,89,239,146,88,32,213,70,221,147,47,220,240,43,96,67,111,36,154,179,12,149,107,17,48,33,149,131,186,41,253,145,33,26,123,38,44,237,191,182,219,245,42,229,208,49,59,0,101,243,157,180,6,170,197,206,173,12,66,209,209,134,158,62,151,201,131,113,191,107,15,162,61,123,191,35,130,150,111,162,130,227,136,53,66,33,99,231,227,207,13,94,43,115,116,82,86,122,252,218,120,204,64,27,130,143,159,136,169,250,152,248,79,152,153,246,210,36,189,183,112,162,95,82,21,122,201,46,124,160,19,8,42,47,159,65,7,165,11,2,198,79,169,80,81,111,216,211,107,107,196,145,228,47,180,62,193,175,118,164,33,45,93,92,175,191,235,150,221,98,254,110,119,170,97,202,21,209,106,3,60,81,77,232,21,57,197,168,119,155,161,65,226,246,137,137,14,131,253,248,65,17,202,122,99,103]]}},"requested_proof":{"revealed_attrs":{},"revealed_attr_groups":{"ref1":{"sub_proof_index":0,"values":{"first_name":{"raw":"Alice","encoded":"27034640024117331033063128044004318218486816931520886405535659934417438781507"},"email":{"raw":"alice@example.com","encoded":"115589951590854546960691112648251660507865356487762333837470597583915671017846"},"last_name":{"raw":"Wonderland","encoded":"16790849312374794736813377567253851373607970473377701477269194019557654562035"}}}},"self_attested_attrs":{},"unrevealed_attrs":{},"predicates":{}},"identifiers":[{"schema_id":"3QowxFtwciWceMFr7WbwnM:2:BasicScheme:0.1","cred_def_id":"CsiDLAiFkQb9N4NDJKUagd:3:CL:4687:NextcloudPrototypeCredentialWithoutRev","rev_reg_id":null,"timestamp":null}]}';
//$proof = '{"proof":{"proofs":[{"primary_proof":{"eq_proof":{"revealed_attrs":{"email":"115589951590854546960691112648251660507865356487762333837470597583915671017846","first_name":"27034640024117331033063128044004318218486816931520886405535659934417438781507","last_name":"16790849312374794736813377567253851373607970473377701477269194019557654562035"},"a_prime":"31465381166530742747255639447087130195671338611616268855750942018470389275950970716747431041744860908629389855582248152236043144276345456922543242175714604123023373657233871569459046137075292076320456141227272969418006510308011959649639521737550591235202212718051094277029105241404212564615758208668648906986888627229733497967834393066730665811271344890916696040664586450215839019535247450471252239306694899702067859718911765158442821660132981842880218209333618308363255111843821524016007189454414438521784459097346495446816782612868379095439414272447641095426091046405823540936625561937664845920535037126363633873084","e":"12575640209888742345087576854702358837833686554004575639381808760653596445457641768850535470136548987360382462936359174668616232866481185","v":"296304656481821464544262408487715777331273230047181676921909503536722344549356464685596627110815207445338842504579775443063559458443199270353902481640014782366663513995746965313007897078490466661193210626887910141689397290783550259326707964642159003049668584966265236051700652952381572599389635319592833866626553244906222306898216592583242224634780948106482759009730048411119106471309168025777321478099055810439965238211458648923570305468550535759905593168238174896490545253160277384163732272053890917138825477550487395876582799869254217049605821489610476587836983378865679547013811210141663742762952058428123432201903679740068661168466505933824039400869669851488228821529763482622306028445349524495258250082247570165672869616725226143705469734744709169466526389602046240551606522805212374563377726760385874171466814603345420650666559121963551356082450345644425603039776373120783340886377578806959416986740170133622255441","m":{"master_secret":"13825483534938740331067544949117627915637110456549605554234107495523333786604031925626371904729142848900519217833887087700959494705765366978121469428107911989273906442147936222856"},"m2":"1965140853268931524856312902554249851554981427652907448326842325669584601061523514082120426154251562759868700116254680390256602295301553121775712631687189702521947696464780574434"},"ge_proofs":[]},"non_revoc_proof":null}],"aggregated_proof":{"c_hash":"26522247541021081104709378928242066624547350242823635408841496285547579968525","c_list":[[249,64,251,22,35,129,204,161,115,129,7,247,245,110,200,249,29,20,189,24,99,110,13,99,141,115,26,85,173,126,252,254,194,235,217,199,153,119,27,65,228,113,188,196,61,175,17,171,77,160,77,64,172,7,196,118,188,160,211,134,27,220,165,103,24,163,33,101,78,7,253,71,17,65,219,7,213,238,41,187,0,227,0,133,141,78,89,183,164,112,78,247,196,57,89,222,203,177,236,130,98,30,45,106,118,39,218,133,11,175,192,181,8,14,140,105,175,125,135,102,123,122,74,203,216,242,179,8,126,151,221,111,196,23,103,242,33,53,37,35,157,33,91,15,120,38,8,60,136,58,154,204,174,246,175,23,179,183,142,240,247,115,207,86,244,20,31,99,99,157,198,58,56,158,169,30,248,65,75,172,250,51,131,157,120,16,44,164,165,158,127,216,92,43,61,135,57,160,175,231,148,20,4,248,202,53,188,192,221,99,253,226,102,83,131,215,255,27,47,184,227,58,213,119,202,110,90,80,68,54,157,105,126,18,71,70,216,64,37,211,219,89,161,127,248,195,227,246,162,90,122,122,114,46,240,188]]}},"requested_proof":{"revealed_attrs":{},"revealed_attr_groups":{"ref1":{"sub_proof_index":0,"values":{"email":{"raw":"alice@example.com","encoded":"115589951590854546960691112648251660507865356487762333837470597583915671017846"},"last_name":{"raw":"Wonderland","encoded":"16790849312374794736813377567253851373607970473377701477269194019557654562035"},"first_name":{"raw":"Alice","encoded":"27034640024117331033063128044004318218486816931520886405535659934417438781507"}}}},"self_attested_attrs":{},"unrevealed_attrs":{},"predicates":{}},"identifiers":[{"schema_id":"3QowxFtwciWceMFr7WbwnM:2:BasicScheme:0.1","cred_def_id":"CsiDLAiFkQb9N4NDJKUagd:3:CL:4687:NextcloudPrototypeCredentialWithoutRev","rev_reg_id":null,"timestamp":null}]}';

$proofRequest = array(
    "nonce" => "69688490727677739773",
    "name" => "proof_req_1",
    "version" => "1.0",
    "requested_attributes" => array(
        "ref1" => array(
            "names" => array("first_name", "last_name", "email"),
            "restrictions" => array(array("schema_id" => $schemaResponse->getId()))
        )
    )
);
$schemas = array(
    $schemaResponse->getId() => json_decode($schemaResponse->getJson())
);
$credentials = array(
    $credDefResponse->getId() => json_decode($credDefResponse->getJson())
);

$valid = $libIndy->verifierVerifyProof(json_encode($proofRequest), $proof, json_encode($schemas), json_encode($credentials), "{}", "{}")->get();
var_dump($valid);