<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(is_desa())
{
  $form = new zea();

  $form->init('param');
  $form->setTable('bumdes_indikator_usaha');
  $paramname = $bumdes_id.'_'.$user_id.'_'.$desa_id;
  $form->setParamName($paramname);
  $form->addInput('unit_usaha','textarea');
  foreach($dana_kat AS $key => $value)
  {
    $form_title = str_replace(' ','_',$key);
    $first_index = '';
    $last_index = '';
    $i = 0;
    foreach($value AS $vkey => $vvalue)
    {
      $title = str_replace(' ','_',$vvalue['value']);
      if($i==0){
        $first_index = $title;
      }
      $last_index = $title;

      $form->addInput($title,'text');
      $form->setLabel($title, $vvalue['value']);
      $i++;
    }
    if(!empty($last_index))
    {
      $form->startCollapse($first_index, $form_title);
      $form->endCollapse($last_index);
      $form->setCollapse($first_index,TRUE);

    }

  }
  $form->form();
  if(!empty($_POST))
  {
    if($form->success)
    {
      $this->bumdes_model->update_indikator_usaha(['bumdes_id'=>$bumdes_id,'desa_id'=>$desa_id,'user_id'=>$user_id], $paramname);
    }
  }
}else{
  $this->load->library('table');
  $template = array(
    'table_open'            => '<table border="1" class="esg_data_table table table-bordered table-hover table-striped" cellpadding="4" cellspacing="2">',

    'thead_open'            => '<thead>',
    'thead_close'           => '</thead>',

    'heading_row_start'     => '<tr>',
    'heading_row_end'       => '</tr>',
    'heading_cell_start'    => '<th>',
    'heading_cell_end'      => '</th>',

    'tbody_open'            => '<tbody>',
    'tbody_close'           => '</tbody>',

    'row_start'             => '<tr>',
    'row_end'               => '</tr>',
    'cell_start'            => '<td>',
    'cell_end'              => '</td>',

    'row_alt_start'         => '<tr>',
    'row_alt_end'           => '</tr>',
    'cell_alt_start'        => '<td>',
    'cell_alt_end'          => '</td>',

    'table_close'           => '</table>'
    );

    $this->table->set_template($template);
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        rekap data Indikator Usaha
        <?php if (is_admin() || is_root()): ?>
          <!-- <a href="<?php echo base_url('admin/corona/kecamatan/') ?>" class="btn btn-sm btn-default"><i class="fa fa-sort"></i> Filter Data</a> -->
        <?php endif ?>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <?php
          echo $this->table->generate($data);
          ?>
        </div>
      </div>
      <div class="panel-footer">
        
      </div>
    </div>
    <?php
}