
<!--this is the footer section of to be included in the main HTML code-->
<footer class="art-footer">
<p style="text-align: center;">Copyright &copy <?php echo date("Y", time()); ?> . All Rights Reserved.</p>
</footer>

    </div>
    <p class="art-page-footer">
        <span id="art-footnote-links">Created by Gideon Kosgei</span>
    </p>
</div>


</body></html>



<?php if(isset($database)) { $database->close_connection(); } ?>




