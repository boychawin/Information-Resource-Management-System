<form action="process.php" method="post">

    <div class="row mb-2">
        <div class="col-md-5">
            <label for="title">คำนำหน้า</label><br>

            <select name="title" id="title" class="form-control w-75">
                <option value="Mr">นาย</option>
                <option value="Mrs">นาง</option>
                <option value="Ms">นางสาว</option>
                <option value="3">อาจารย์</option>
                <option value="4">รองศาสตราจารย์</option>
                <option value="5">ผู้ช่วยศาสตราจารย์</option>
                <option value="Dr">ดร.</option>
                <option value="Ap.Dr">รศ.ดร</option>
            </select>

            <label for="username">ชื่อผู้ใช้</label><br>
            <input type="text" name="username" id="username">
            <br>
            <label for="firstname">ชื่อจริง</label><br>
            <input type="text" name="firstname" id="firstname">
            <br>

            <label for="lastname">นามสกุล</label><br>
            <input type="text" name="lastname" id="lastname">
            <br>
        </div>
        <div class="col-md-5">
            <label class="padding-none">หมายเลขโทรศัพท์</label>
            <hr class="divider">

            <label for="code" class="text-sm">เครือข่าย</label><br>
            <select name="country-code" id="code" class="form-control w-75">
                <?php
                echo "<option value='AIS'>AIS</option>";
                echo "<option value='DTAC'>DTAC</option>";
                echo "<option value='TrueMove H'>TrueMove H</option>";
                echo "<option value='my By CAT'>my By CAT</option>";
                echo "<option value='TOT'>TOT</option>";

                echo "<option value='other'>อื่นๆ</option>";
                ?>
            </select>

            <label for="phone" class="text-sm">หมายเลข</label><br>
            <input type="text" name="phone" placeholder="902289893" id="phone">

            <br>
            <label for="email">อีเมล</label><br>
            <input name="email" id="email">
            <br>

            <label for="password">รหัสผ่าน</label><br>
            <input type="password" name="password" id="password">
        </div>
        <button class="btn btn-warning ml-5" type="submit">เพิ่ม</button>
    </div>
</form>