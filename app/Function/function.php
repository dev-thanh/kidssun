<?php

/*use function foo\func;*/

define("__IMAGE_DEFAULT__", asset('public/backend/img/placeholder.png'));
define("__BASE_URL__", url('public/frontend'));

use App\Models\Options;

function renderImage($link)
{
    if (!empty($link)) {
        return $link;
    }
    return asset('public/backend/img/no-image.png');
}

function text_limit($str, $limit = 10)
{
    if (stripos($str, " ")) {
        $ex_str = explode(" ", $str);
        if (count($ex_str) > $limit) {
            $str_s = null;
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] .
                    " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

function menuChildren($data, $id, $item)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<ol class="dd-list">';
        foreach ($item->get_child_cate() as $item) {
            if ($item->parent_id == $id) {
                echo '<li class="dd-item" data-id="' . $item->id . '">';
                echo '  <div class="dd-handle">' . $item->title . '(<i>' . $item->url . '</i>)</div>
                                    <div class="button-group">
                                        <a href="javascript:;" class="modalEditMenu" data-id="' . $item->id . '"> 
                                            <i class="fa fa-pencil fa-fw"></i> Sửa
                                        </a> &nbsp; &nbsp; &nbsp;
                                        <a class="text-danger" href="' . route('setting.menu.delete', $item['id']) . '" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                                    </div>';
                menuChildren($data, $item->id, $item);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}

function renderLinkAddPostType()
{
    $type = request()->get('type');
    if ($type == 'blog') {
        return [
            'title'    => 'Bài Viết',
            'linkAdd'  => route('posts.create', ['type' => 'blog']),
            'linkList' => route('posts.index', ['type' => 'blog']),
        ];
    }
}

// function listCate($data, $parent_id = 0, $str = '')
// {
//     foreach ($data as $value) {
//         $id   = $value->id;
//         $name = $value->name;
//         if ($value->parent_id == $parent_id) {
//             if ($str == '') {
//                 $strName = '<b>' . $str . $name . '</b>';
//             } else {

//                 $strName = $str . $name;
//             }
//             echo '<tr class="odd">';
//             echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
//             // echo "<td><img src='$value->image' class='img-responsive imglist'></td>";
//             echo '<td>
//                         <a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa">' . $strName . '</a></br>
//                         <a href="' . asset('danh-muc/' . $value->slug) . '" target="_blank"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: ' . asset('danh-muc/' . $value->slug) . ' </a> 
//                     </td>';
//             echo '<td><a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a>
//                         </td>';
//             echo ' <td><a href="' . route('category.edit', $id) . '" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
//                                 <a href="javascript:;" class="btn-destroy" data-href="' . route('category.destroy', $id) . '" data-toggle="modal" data-target="#confim">
//                                     <i class="fa fa-trash-o fa-fw"></i> Xóa
//                                 </a>
//                             </td>';
//             echo '</tr>';

//             listCate($data, $id, $str . '---| ');
//         }
//     }
// }

function checkBoxCategory($data, $id, $item, $list_id = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                            <input type="checkbox" class="category" name="category[]" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                        </label>';
                checkBoxCategory($data, $value->id, $item);
            }
        }
        echo '</div>';
    }
}

function checkBoxCategoryName($data, $id, $item, $list_id = null, $name = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                            <input type="checkbox" class="category" name="'.$name.'" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                        </label>';
                checkBoxCategory($data, $value->id, $item);
            }
        }
        echo '</div>';
    }
}


function dequy($datas)
{
    $list_ids = [];
    foreach ($datas as $data) {
        $list_ids[] = $data->id;
        if ($data->get_child_cate()->count() > 0) {
            $list_ids = array_merge($list_ids, dequy($data->get_child_cate()));
        }
    }
    return $list_ids;
}

function get_list_ids($datas)
{
    return $datas ? dequy($datas->get_child_cate()) : null;
}

function getlistcate($data, $id)
{
    foreach ($data as $item) {
        if ($item->parent_id == $id) {
            echo '<li class="active"><a href="' . route('home.getActive', ['slug' => $item->slug, 'id' => $item->id]) . '">' . $item->name . '</a></li>';
            getlistcate($data, $item->id);
        }
    }
}

function getListParent($data)
{
    $parent = $data;
    if ($data->parent_id > 0) {
        $parent = $data->getParent();
        $parent = getListParent($parent);
    }
    return $parent;
}

function menuMulti($data, $parent_id = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $id . ' selected> ' . $str . $value->name . ' </option>';
            } else {
                echo '<option value=' . $id . '> ' . $str . $value->name . ' </option>';
            }
            menuMulti($data, $id, $str . '---|  ', $select);
        }
    }
}
function getOptions($key = null, $field = null)
{
    if(!empty($key)){
        $data = Options::where('type', $key)->first();
        if(!empty($data)){
            $data = json_decode($data->content);
            if(!empty($field)){
                return !empty($data->{ $field }) ? $data->{ $field } : $data;
            }
            return $data;
        }
        return 'key does not exist';
    }
    return 'error';
}


    function renderAction($method)
    {
        return isUpdate($method) ? 'Cập nhật' : 'Thêm mới' ;
    }


    function isUpdate($method)
    {
        return (bool)$method == 'update';
    }

    function updateOrStoreRouteRender($method, $model, $data)
    {
        return isUpdate($method) ? route($model . '.update', $data) : route($model . '.store');
    }

    
    function generateRandomCode() 
    {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1, 10);
    }

    function listCate($data, $parent_id = 0, $str = '')
    {
        foreach ($data as $value) {
            $id   = $value->id;
            $name = $value->name;
            if ($value->parent_id == $parent_id) {
                if ($str == '') {
                    $strName = '<b>' . $str . $name . '</b>';
                } else {

                    $strName = $str . $name;
                }
                if($value->status==1){
                    $status = '<label class="label label-success">Hiển thị trang chủ</label>';
                }else{
                    $status = '<label class="label label-danger">Không hiển thị</label>';
                }
                echo '<tr class="odd">';
                echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
                
                echo '<td>
                        <span class="text-default" >' . $strName . '</span> 
                        </td>';
                echo '<td>
                        <span class="text-default">' . $value->slug . '</a>
                        </td>';
                echo '<td>'.$status.'</td>';

                echo ' <td><a href="' . route('category.edit', $id) . '" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                            <a href="javascript:;" class="btn-destroy" data-href="' . route('category.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                                <i class="fa fa-trash-o fa-fw"></i> Xóa
                            </a>
                    </td>';
                echo '</tr>';

                listCate($data, $id, $str . '---| ');
            }
        }
    }

    function menuMulticateproduct($data, $parent_id = 0, $str = '---| ', $select = 0)
    {
        foreach ($data as $value) {
            $id   = $value->id;
            $name = $value->name;
            if ($value->parent_id == $parent_id) {
                if ($select != 0 && $id == $select) {
                    echo '<option value=' . $id . ' selected> ' . $str . $value->name . ' </option>';
                } else {
                    echo '<option value=' . $id . ' data-level='.$value->level.'> ' . $str . $value->name . ' </option>';
                }
                menuMulticateproduct($data, $id, $str . '---|  ', $select);
            }
        }
    }

    function menueditcategoryproduct($data,$parent_id = 0, $str = '', $select = 0,$selected)
    {
        foreach ($data as $value) {
            $id   = $value->id;
            $name = $value->name;
            if($id == $selected){
                $sl = 'selected';
            }else{
                $sl ='';
            }
            if ($value->parent_id == $parent_id) {              
                echo '<option value=' . $id . ' '.$sl.'> ' . $str . $value->name . ' </option>';
                menueditcategoryproduct($data, $id, $str . '---|  ', $select,$selected);
            }
        }
    }

