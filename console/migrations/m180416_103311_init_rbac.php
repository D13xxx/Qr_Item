<?php

use yii\db\Migration;

/**
 * Class m180416_103311_init_rbac
 */
class m180416_103311_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $auth = Yii::$app->authManager;

//        // add "createnhom san pham" permission
//        $taoMoiNhomSanPham = $auth->createPermission('nhom-san-pham/create');
//        $taoMoiNhomSanPham->description = 'Tạo mới nhóm sản phẩm';
//        $auth->add($taoMoiNhomSanPham);
//
//        // danh sách sản phẩm
//        $danhSachNhomSP = $auth->createPermission('nhom-san-pham/index');
//        $danhSachNhomSP->description = 'Danh sách nhóm sản phẩm';
//        $auth->add($danhSachNhomSP);
//
//        // add "updatePost" permission
//        $chinhSuaNhomSanPham = $auth->createPermission('nhom-san-pham/update');
//        $chinSuaNhomSanPham->description = 'Chỉnh sửa thông tin nhóm sản phẩm';
//        $auth->add($chinhSuaNhomSanPham);
//
//
//        $kiemDuyetNhomSanPham = $auth->createPermission('kiem-duyet-nhom-san-pham%2Findex');
//        $kiemDuyetNhomSanPham->description = 'Kiểm duyệt nhóm sản phẩm';
//        $auth->add($kiemDuyetNhomSanPham);
//
//        $nhomSanPhamDaDuyet = $auth->createPermission('nhom-san-pham%2Fda-duyet');
//        $nhomSanPhamDaDuyet->description = 'Kiểm duyệt nhóm sản phẩm';
//        $auth->add($kiemDuyetNhomSanPham);
//
//
//        $taoMoiSanPham = $auth->createPermission('san-pham/create');
//        $taoMoiSanPham->description = 'Tạo mới sản phẩm';
//        $auth->add($taoMoiSanPham);
//
//        // danh sách sản phẩm
//        $danhSachSP = $auth->createPermission('san-pham/index');
//        $danhSachSP->description = 'Danh sách sản phẩm';
//        $auth->add($danhSachSP);
//
//        // add "updatePost" permission
//        $chinhSuaSanPham = $auth->createPermission('san-pham/update');
//        $chinSuaNhomSanPham->description = 'Chỉnh sửa thông tin sản phẩm';
//        $auth->add($chinhSuaSanPham);
//
//
//        $kiemDuyetSanPham = $auth->createPermission('kiem-duyet-san-pham/index');
//        $kiemDuyetSanPham->description = 'Kiểm duyệt nhóm sản phẩm';
//        $auth->add($kiemDuyetSanPham);
//
//
//        $sanPhamDaDuyet = $auth->createPermission('san-pham/da-duyet');
//        $sanPhamDaDuyet->description = 'Kiểm duyệt nhóm sản phẩm';
//        $auth->add($sanPhamDaDuyet);
//
//
//        // add "author" role and give this role the "createPost" permission
//        $author = $auth->createRole('AdminCompany');
//        $auth->add($author);
//        $auth->addChild($author, $createPost);
//
//        // add "admin" role and give this role the "updatePost" permission
//        // as well as the permissions of the "author" role
//        $admin = $auth->createRole('admin');
//        $auth->add($admin);
//        $auth->addChild($admin, $updatePost);
//        $auth->addChild($admin, $author);
//
//        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
//        // usually implemented in your User model.
//        $auth->assign($author, 2);
//        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        // echo "m180416_103311_init_rbac cannot be reverted.\n";

        return false;
    }
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);

            // the following three lines were added:
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('author');
            $auth->assign($authorRole, $user->getId());

            return $user;
        }

        return null;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180416_103311_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
