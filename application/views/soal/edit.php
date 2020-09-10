<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('soal/save', array('id'=>'formsoal'), array('method'=>'edit', 'id_soal'=>$soal->id_soal));?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="guru_id" class="control-label">Guru (Mata Pelajaran)</label>
                                <?php if( $this->ion_auth->is_admin() ) : ?>
                                <select required="required" name="guru_id" id="guru_id" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih guru</option>
                                    <?php 
                                    $sdm = $soal->guru_id.':'.$soal->mapel_id;
                                    foreach ($guru as $d) : 
                                        $dm = $d->id_guru.':'.$d->mapel_id;?>
                                        <option <?=$sdm===$dm?"selected":"";?> value="<?=$dm?>"><?=$d->nama_guru?> (<?=$d->nama_mapel?>)</option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('guru_id')?></small>
                                <?php else : ?>
                                <input type="hidden" name="guru_id" value="<?=$guru->id_guru;?>">
                                <input type="hidden" name="mapel_id" value="<?=$guru->mapel_id;?>">
                                <input type="text" readonly="readonly" class="form-control" value="<?=$guru->nama_guru; ?> (<?=$guru->nama_mapel; ?>)">
                                <?php endif; ?>
                            </div>

                            <div class="form-group col-sm-12">
                                <label>Hambatan Belajar</label>
                                <select required="required" name="id_hambatan" id="id_hambatan" class="select2 form-group" style="width:100% !important">
                                    <option value="" disabled selected>Pilih Hambatan Belajar</option>
                                    <?php 
                                    $sdm = $soal->id_hambatan.':'.$soal->id_soal;
                                    $hambatan_soal_sekarang = $soal->id_hambatan;
                                    foreach ($learningObstacle as $d) :
                                    $soal_sekarang = $d->id; 
                                        $dm = $d->id.':'.$d->id_soal;?>
                                        <option <?=$hambatan_soal_sekarang===$soal_sekarang?"selected":"";?> value="<?=$dm?>"><?=$d->lo?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="help-block" style="color: #dc3545"><?=form_error('guru_id')?></small>
                            </div>
                            
                            <div class="col-sm-12">
                                <label for="soal" class="control-label text-center">Soal</label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="file_soal" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                                        <?php if(!empty($soal->file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->file);?>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="soal" id="soal" class="form-control froala-editor"><?=$soal->soal?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 
                                Membuat perulangan A-E 
                            -->
                            <?php
                            $abjad = ['a', 'b', 'c', 'd', 'e']; 
                            foreach ($abjad as $abj) :
                                $ABJ = strtoupper($abj); // Abjad Kapital
                                $file = 'file_'.$abj;
                                $opsi = 'opsi_'.$abj;
                            ?>
                            
                            <div class="col-sm-12">
                                <label for="jawaban_<?= $abj; ?>" class="control-label text-center">Jawaban <?= $ABJ; ?></label>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <input type="file" name="<?= $file; ?>" class="form-control">
                                        <small class="help-block" style="color: #dc3545"><?=form_error($file)?></small>
                                        <?php if(!empty($soal->$file)) : ?>
                                            <?=tampil_media('uploads/bank_soal/'.$soal->$file);?>
                                        <?php endif;?>
                                    </div>
                                    <div class="form-group col-sm-9">
                                        <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control froala-editor"><?=$soal->$opsi?></textarea>
                                        <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach; ?>
                            
                            <div class="form-group col-sm-12">
                                <label for="jawaban" class="control-label">Kunci Jawaban</label>
                                <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                    <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                    <option <?=$soal->jawaban==="A"?"selected":""?> value="A">A</option>
                                    <option <?=$soal->jawaban==="B"?"selected":""?> value="B">B</option>
                                    <option <?=$soal->jawaban==="C"?"selected":""?> value="C">C</option>
                                    <option <?=$soal->jawaban==="D"?"selected":""?> value="D">D</option>
                                    <option <?=$soal->jawaban==="E"?"selected":""?> value="E">E</option>
                                </select>                
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="bobot" class="control-label">Bobot Nilai</label>
                                <input required="required" value="<?=$soal->bobot?>" type="number" name="bobot" placeholder="Bobot Soal" id="bobot" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group pull-right">
                                    <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Batal</a>
                                    <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>