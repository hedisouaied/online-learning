<style>


.marquee_text {
    font-size: 6rem;
    font-weight: bold;
    line-height: 7rem;

    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
<div>
<div class="marquee_text">
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
    <img src="https://e-smarttec.com/uploads/part/1623331926_456.png" />
</div>
</div>
<script>
    // Start marquee
$('.marquee_text').marquee({
    direction: 'left',
    duration: 50000,
    gap: 50,
    delayBeforeStart: 0,
    duplicated: true,
    startVisible: true
});
</script>