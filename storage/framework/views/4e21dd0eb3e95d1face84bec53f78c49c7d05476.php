<html>
<head>

</head>
<body>
<div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:750px; height:550px; padding:20px;  border: 5px solid #787878">
        <div style="text-align:center;">
            <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
            <br><br>
            <span style="font-size:25px"><i>This is to certify that</i></span>
            <br><br>
            <span style="font-size:30px"><b><?php echo e($student_name); ?></b></span><br/><br/>
            <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
            <span style="font-size:30px"><?php echo e($course_name); ?></span> <br/><br/>
            <span style="font-size:25px"><i>dated</i></span><br>
            <span style="font-size:30px"><?php echo e($date); ?></span><br/><br/>
        </div>
        <div style="text-align: right; padding-right: 20px;">
            <img src="<?php echo e($signature_image); ?>" alt="Signature" style="text-align: right;height: 50px;width: 100px;">
            <p style="font-size:30px;text-decoration: overline;"><?php echo e($teacher_name); ?></p>
        </div>
    </div>
</div>
</body>
</html>