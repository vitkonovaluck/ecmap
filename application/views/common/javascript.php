<script type="text/javascript">


function open_doc(id){
    document.location.href = "<?php echo base_url('Documents/?id=');?>"+id;
}


</script>

<script type=text/javascript>
            function setScreenHWCookie() {
                $.cookie('sw',screen.width);
                $.cookie('sh',screen.height);
                return true;
            }
            setScreenHWCookie();
        </script>