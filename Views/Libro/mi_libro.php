<?php
    use Models\Libro;
    $libro = Libro::getAllLibrosFromId($id);
    $libro = $libro->fetchAll();


    $nombre_imagen = str_replace(" ", "", $libro[0]['titulo']);
    $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
    if(!file_exists($imagen)) {
        $imagen = $_ENV['BASE_URL_IMG'].'Error404/ImgNotFound.png';
    }

?>
<style>
    /* .page:nth-child(8) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-8px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(8) {
        transform: translatez(8px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(9) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-9px);
        background: #f5f5f5;
    }
    .left-side:nth-child(9) {
        transform: translatez(9px) rotatey(-180deg);
    }
    .page:nth-child(10) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-10px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(10) {
        transform: translatez(10px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(11) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-11px);
        background: #ccc;
    }
    .left-side:nth-child(11) {
        transform: translatez(11px) rotatey(-180deg);
    }
    .page:nth-child(12) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-12px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(12) {
        transform: translatez(12px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(13) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-13px);
        background: #ccc;
    }
    .left-side:nth-child(13) {
        transform: translatez(13px) rotatey(-180deg);
    }
    .page:nth-child(14) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-14px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(14) {
        transform: translatez(14px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(15) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-15px);
        background: #ccc;
    }
    .left-side:nth-child(15) {
        transform: translatez(15px) rotatey(-180deg);
    }
    .page:nth-child(16) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-16px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(16) {
        transform: translatez(16px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(17) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-17px);
        background: #ccc;
    }
    .left-side:nth-child(17) {
        transform: translatez(17px) rotatey(-180deg);
    }
    .page:nth-child(18) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-18px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(18) {
        transform: translatez(18px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(19) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-19px);
        background: #ccc;
    }
    .left-side:nth-child(19) {
        transform: translatez(19px) rotatey(-180deg);
    }
    .page:nth-child(20) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-20px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(20) {
        transform: translatez(20px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(21) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-21px);
        background: #f5f5f5;
    }
    .left-side:nth-child(21) {
        transform: translatez(21px) rotatey(-180deg);
    }
    .page:nth-child(22) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-22px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(22) {
        transform: translatez(22px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(23) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-23px);
        background: #f5f5f5;
    }
    .left-side:nth-child(23) {
        transform: translatez(23px) rotatey(-180deg);
    }
    .page:nth-child(24) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-24px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(24) {
        transform: translatez(24px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(25) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-25px);
        background: #f5f5f5;
    }
    .left-side:nth-child(25) {
        transform: translatez(25px) rotatey(-180deg);
    }
    .page:nth-child(26) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-26px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(26) {
        transform: translatez(26px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(27) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-27px);
        background: #f5f5f5;
    }
    .left-side:nth-child(27) {
        transform: translatez(27px) rotatey(-180deg);
    }
    .page:nth-child(28) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-28px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(28) {
        transform: translatez(28px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(29) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-29px);
        background: #f5f5f5;
    }
    .left-side:nth-child(29) {
        transform: translatez(29px) rotatey(-180deg);
    }
    .page:nth-child(30) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-30px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(30) {
        transform: translatez(30px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(31) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-31px);
        background: #ccc;
    }
    .left-side:nth-child(31) {
        transform: translatez(31px) rotatey(-180deg);
    }
    .page:nth-child(32) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-32px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(32) {
        transform: translatez(32px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(33) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-33px);
        background: #ccc;
    }
    .left-side:nth-child(33) {
        transform: translatez(33px) rotatey(-180deg);
    }
    .page:nth-child(34) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-34px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(34) {
        transform: translatez(34px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(35) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-35px);
        background: #ccc;
    }
    .left-side:nth-child(35) {
        transform: translatez(35px) rotatey(-180deg);
    }
    .page:nth-child(36) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-36px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(36) {
        transform: translatez(36px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(37) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-37px);
        background: #ccc;
    }
    .left-side:nth-child(37) {
        transform: translatez(37px) rotatey(-180deg);
    }
    .page:nth-child(38) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-38px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(38) {
        transform: translatez(38px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(39) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-39px);
        background: #ccc;
    }
    .left-side:nth-child(39) {
        transform: translatez(39px) rotatey(-180deg);
    }
    .page:nth-child(40) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-40px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(40) {
        transform: translatez(40px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(41) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-41px);
        background: #f5f5f5;
    }
    .left-side:nth-child(41) {
        transform: translatez(41px) rotatey(-180deg);
    }
    .page:nth-child(42) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-42px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(42) {
        transform: translatez(42px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(43) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-43px);
        background: #f5f5f5;
    }
    .left-side:nth-child(43) {
        transform: translatez(43px) rotatey(-180deg);
    }
    .page:nth-child(44) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-44px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(44) {
        transform: translatez(44px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(45) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-45px);
        background: #f5f5f5;
    }
    .left-side:nth-child(45) {
        transform: translatez(45px) rotatey(-180deg);
    }
    .page:nth-child(46) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-46px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(46) {
        transform: translatez(46px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(47) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-47px);
        background: #f5f5f5;
    }
    .left-side:nth-child(47) {
        transform: translatez(47px) rotatey(-180deg);
    }
    .page:nth-child(48) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-48px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(48) {
        transform: translatez(48px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(49) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-49px);
        background: #f5f5f5;
    }
    .left-side:nth-child(49) {
        transform: translatez(49px) rotatey(-180deg);
    }
    .page:nth-child(50) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-50px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(50) {
        transform: translatez(50px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(51) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-51px);
        background: #ccc;
    }
    .left-side:nth-child(51) {
        transform: translatez(51px) rotatey(-180deg);
    }
    .page:nth-child(52) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-52px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(52) {
        transform: translatez(52px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(53) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-53px);
        background: #ccc;
    }
    .left-side:nth-child(53) {
        transform: translatez(53px) rotatey(-180deg);
    }
    .page:nth-child(54) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-54px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(54) {
        transform: translatez(54px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(55) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-55px);
        background: #ccc;
    }
    .left-side:nth-child(55) {
        transform: translatez(55px) rotatey(-180deg);
    }
    .page:nth-child(56) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-56px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(56) {
        transform: translatez(56px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(57) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-57px);
        background: #ccc;
    }
    .left-side:nth-child(57) {
        transform: translatez(57px) rotatey(-180deg);
    }
    .page:nth-child(58) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-58px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(58) {
        transform: translatez(58px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(59) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-59px);
        background: #ccc;
    }
    .left-side:nth-child(59) {
        transform: translatez(59px) rotatey(-180deg);
    }
    .page:nth-child(60) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-60px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(60) {
        transform: translatez(60px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(61) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-61px);
        background: #f5f5f5;
    }
    .left-side:nth-child(61) {
        transform: translatez(61px) rotatey(-180deg);
    }
    .page:nth-child(62) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-62px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(62) {
        transform: translatez(62px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(63) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-63px);
        background: #f5f5f5;
    }
    .left-side:nth-child(63) {
        transform: translatez(63px) rotatey(-180deg);
    }
    .page:nth-child(64) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-64px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(64) {
        transform: translatez(64px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(65) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-65px);
        background: #f5f5f5;
    }
    .left-side:nth-child(65) {
        transform: translatez(65px) rotatey(-180deg);
    }
    .page:nth-child(66) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-66px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(66) {
        transform: translatez(66px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(67) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-67px);
        background: #f5f5f5;
    }
    .left-side:nth-child(67) {
        transform: translatez(67px) rotatey(-180deg);
    }
    .page:nth-child(68) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-68px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(68) {
        transform: translatez(68px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(69) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-69px);
        background: #f5f5f5;
    }
    .left-side:nth-child(69) {
        transform: translatez(69px) rotatey(-180deg);
    }
    .page:nth-child(70) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-70px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(70) {
        transform: translatez(70px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(71) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-71px);
        background: #ccc;
    }
    .left-side:nth-child(71) {
        transform: translatez(71px) rotatey(-180deg);
    }
    .page:nth-child(72) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-72px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(72) {
        transform: translatez(72px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(73) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-73px);
        background: #ccc;
    }
    .left-side:nth-child(73) {
        transform: translatez(73px) rotatey(-180deg);
    }
    .page:nth-child(74) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-74px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(74) {
        transform: translatez(74px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(75) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-75px);
        background: #ccc;
    }
    .left-side:nth-child(75) {
        transform: translatez(75px) rotatey(-180deg);
    }
    .page:nth-child(76) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-76px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(76) {
        transform: translatez(76px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(77) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-77px);
        background: #ccc;
    }
    .left-side:nth-child(77) {
        transform: translatez(77px) rotatey(-180deg);
    }
    .page:nth-child(78) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-78px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(78) {
        transform: translatez(78px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(79) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-79px);
        background: #ccc;
    }
    .left-side:nth-child(79) {
        transform: translatez(79px) rotatey(-180deg);
    }
    .page:nth-child(80) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-80px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(80) {
        transform: translatez(80px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(81) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-81px);
        background: #f5f5f5;
    }
    .left-side:nth-child(81) {
        transform: translatez(81px) rotatey(-180deg);
    }
    .page:nth-child(82) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-82px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(82) {
        transform: translatez(82px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(83) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-83px);
        background: #f5f5f5;
    }
    .left-side:nth-child(83) {
        transform: translatez(83px) rotatey(-180deg);
    }
    .page:nth-child(84) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-84px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(84) {
        transform: translatez(84px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(85) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-85px);
        background: #f5f5f5;
    }
    .left-side:nth-child(85) {
        transform: translatez(85px) rotatey(-180deg);
    }
    .page:nth-child(86) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-86px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(86) {
        transform: translatez(86px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(87) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-87px);
        background: #f5f5f5;
    }
    .left-side:nth-child(87) {
        transform: translatez(87px) rotatey(-180deg);
    }
    .page:nth-child(88) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-88px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(88) {
        transform: translatez(88px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(89) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-89px);
        background: #f5f5f5;
    }
    .left-side:nth-child(89) {
        transform: translatez(89px) rotatey(-180deg);
    }
    .page:nth-child(90) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-90px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(90) {
        transform: translatez(90px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(91) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-91px);
        background: #ccc;
    }
    .left-side:nth-child(91) {
        transform: translatez(91px) rotatey(-180deg);
    }
    .page:nth-child(92) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-92px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(92) {
        transform: translatez(92px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(93) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-93px);
        background: #ccc;
    }
    .left-side:nth-child(93) {
        transform: translatez(93px) rotatey(-180deg);
    }
    .page:nth-child(94) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-94px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(94) {
        transform: translatez(94px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(95) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-95px);
        background: #ccc;
    }
    .left-side:nth-child(95) {
        transform: translatez(95px) rotatey(-180deg);
    }
    .page:nth-child(96) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-96px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(96) {
        transform: translatez(96px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(97) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-97px);
        background: #ccc;
    }
    .left-side:nth-child(97) {
        transform: translatez(97px) rotatey(-180deg);
    }
    .page:nth-child(98) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-98px) scalex(-1) translatex(100%);
        background: #ccc;
    }
    .left-side:nth-child(98) {
        transform: translatez(98px) scalex(-1) translatex(100%) rotatey(180deg);
    }
    .page:nth-child(99) {
        padding: 5% 4% 4% 5%;
        transform-origin: 0% 50%;
        transform: translatez(-99px);
        background: #ccc;
    }
    .left-side:nth-child(99) {
        transform: translatez(99px) rotatey(-180deg);
    }
    .page:nth-child(100) {
        padding: 5% 5% 4% 4%;
        transform-origin: 100% 50%;
        transform: translatez(-100px) scalex(-1) translatex(100%);
        background: #f5f5f5;
    }
    .left-side:nth-child(100) {
        transform: translatez(100px) scalex(-1) translatex(100%) rotatey(180deg);
    } */
</style>
<div class="books">
    <div class="book">
        <div class="page cover-front" onclick="movePage(this, 1)" style="background:url(<?=$imagen?>);background-repeat:no-repeat;background-size:cover;">
        </div>
        <div class="page cover-front" onclick="movePage(this, 2)"></div>
        <div class="page text-page" onclick="movePage(this, 3)">
            <p><?=$libro[0]['titulo']?></p>
            <p><?=$libro[0]['descripcion']?></p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris. Integer sagittis vel orci a pellentesque.</p>
        </div>
        <div class="page text-page" onclick="movePage(this, 4)">
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
            <br>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
        </div>
        <div class="page text-page" onclick="movePage(this, 5)">
        <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
            <br>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
        </div>
        <div class="page text-page" onclick="movePage(this, 6)">
        <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
            <br>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae mi vitae nisi luctus tristique. Nunc sem ipsum, molestie sit amet sem id, bibendum posuere quam. In in ultricies magna. Duis ac mollis dui. Mauris rhoncus metus vehicula ipsum auctor facilisis. Curabitur vulputate, magna et aliquet ornare, lacus nisl interdum magna, eget tempus arcu sapien blandit urna. Duis tincidunt, diam ut viverra egestas, nisi augue pellentesque dolor, et facilisis diam magna nec quam. Phasellus ligula felis, rhoncus in malesuada in, porttitor vel mauris.</p>
        </div>
        <div class="page">
            <h1 style="text-align: center;margin-top:50%;">
                <a href="<?=$_ENV['BASE_URL']?>libro_devolver/<?=$libro[0]['id']?>">Devolver Libro</a>
            </h1>
        </div>
        
    </div>

    <div class="book1" style="display:none;">
        <form action="download_pdf" method="POST">
            <?php
                $descripcion = str_replace('"', '', $libro[0]['descripcion']);
            ?>
            <input type="hidden" name="titulo" value="<?=$libro[0]['titulo']?>">
            <input type="hidden" name="descripcion" value="<?=$descripcion?>">
            <!-- <input type="hidden" name="descripcion" value="<?=$libro[0]['descripcion']?>"> -->
            <button type="submit">
                <div class="download_book" style="background:url(<?=$imagen?>);">
                </div>
            </button>
        </form>
        <h3 style="text-align:center;">
            <a href="<?=$_ENV['BASE_URL']?>libro_devolver/<?=$libro[0]['id']?>">Devolver Libro</a>
        </h3>
    </div>
</div>

<script type="text/javascript">
    let currentPage = 1;
    function toggleClass(e, toggleClassName) {
        if(e.className.includes(toggleClassName)) {
            e.className = e.className.replace(' ' + toggleClassName, '');
        } else {
            e.className += ' ' + toggleClassName;
        }
    }
    function movePage(e, page) {
        if (page == currentPage) {
            currentPage+=2;
            toggleClass(e, "left-side");
            toggleClass(e.nextElementSibling, "left-side"); 
        }
        else if (page = currentPage - 1) {
            currentPage-=2;
            toggleClass(e, "left-side");
            toggleClass(e.previousElementSibling, "left-side");
        }
    }


    $(window).resize(function() {
        if($(window).width() < 1024 && $(".book").is(":visible")) {
            $(".book").toggle();
            $(".book1").toggle();
            $(".books").css("height", "auto");
            $(".books").css("min-height", "auto");
        }else if($(window).width() >= 1024 && $(".book1").is(":visible")) {
            $(".book").toggle();
            $(".book1").toggle();
            $(".books").css("height", "80vh");
            $(".books").css("min-height", "700px");
        }
    });
    $(window).ready(function() {
        if($(window).width() < 1024 && $(".book").is(":visible")) {
            $(".book").toggle();
            $(".book1").toggle();
            $(".books").css("height", "auto");
            $(".books").css("min-height", "auto");
        }else if($(window).width() >= 1024 && $(".book1").is(":visible")) {
            $(".book").toggle();
            $(".book1").toggle();
            $(".books").css("height", "80vh");
            $(".books").css("min-height", "700px");
        }
    });
    
    
</script>