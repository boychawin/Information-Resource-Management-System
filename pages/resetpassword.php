<?php
include_once 'header.php'; ?>
<div class="container my-5">
    <div class="card">
        <form name="form1" method="post" action="" id="form1">
            <div>
                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE"
                    value="/wEPDwUKMTkxNTczMjc3OA9kFgICAw9kFgYCAQ8PFgIeBFRleHQFFmNoYXdpbi5oaTYwQHNucnUuYWMudGhkZAIDDw8WAh8ABSvguJnguLLguKLguIrguKfguLTguJkg4Lir4Li04LiV4Liw4LiE4Li44LiTZGQCBQ8PFgIfAAUJYm95Y2hhd2luZGRk/1ScoW63pAB//R8UV5nVXV2exVAl3RD9Pauw0AqeyIg=">
            </div>
            <div>
                <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="67D8EB8A">
                <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION"
                    value="/wEdAAf6qx9+41E5fWzMQZ66cweelLkmGc+MpuBWL53Z1T7n8VQg59qX54HeT0pfUdX3dFhA7FXHOa4Dm9Y5t1Vr7Jj9Unwgs1hDdHjKXfW0qd9M3PrLgxNATYMmS8t6OCh4U37N+DvxnwFeFeJ9MIBWR6938kHQEx6lD0RsTIsnwrEGX1h/gIgU9/u1e/tTDNzzm2Y=">
            </div>
            <div class="container">

                <div id="login">
                    <h2 class="style77">
                        <span class="fontawesome-lock"></span>
                        รีเซ็ตรหัสผ่าน
                    </h2>
                    <fieldset>
                        <p class="style39">
                            <label for="email" class="style66">
                                E-Mail Address</label>
                        </p>
                        <p>
                            <input name="txt_email" value="chawin.hi60@snru.ac.th" id="txt_email" disabled="disabled"
                                type="email" class="form-control">
                        </p>
                        <p class="style39">
                            <label class="style66">
                                ชื่อนาม - สกุล</label>
                        </p>
                        <p>
                            <input name="txtname" type="text" value="นายชวิน หิตะคุณ" id="txtname" disabled="disabled"
                                class="form-control">
                        </p>
                        <p class="style39">
                            <label class="style66">
                                ชื่อเข้าใช้ระบบ</label>
                        </p>
                        <p>
                            <input name="txtuserlogin" type="text" value="boychawin" id="txtuserlogin"
                                disabled="disabled" class="form-control">
                        </p>
                        <p class="style39">
                            <label class="style66">
                                รหัสผ่านใหม่</label>
                        </p>
                        <p>
                            <input name="txtnewpasswd" type="password" id="txtnewpasswd" class="form-control" class="">
                        </p>
                        <p class="style39">
                            <label class="style66">
                                ยืนยันรหัสผ่านใหม่</label>
                        </p>
                        <p>
                            <input name="txtconfrompasswd" type="password" id="txtconfrompasswd" class="form-control">
                        </p>

                        <p class="style39">

                        </p>
                        <p>
                            <input type="submit" name="Button1" value="ตกลง" id="Button1" class="btn btn-primary"
                                style="height:100%;width:100%;">
                        </p>
                        <p>
                            &nbsp;</p>
                    </fieldset>
                </div>
                <!-- end login -->
            </div>
        </form>
    </div>
</div>

<?php include_once 'footer.php';
?>