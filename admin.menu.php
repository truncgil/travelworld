<ul class="metismenu" id="menu">
										
										<li>
											<a href="#" aria-expanded="true">
												<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Tüm İçerikler</span>
												<span class="fa arrow"></span>
											</a>
											<ul aria-expanded="true" class="collapse">
												<li><a href="?i=icerikler"><i class="fa fa-folder"></i> Ana İçerikler</a></li>
												<li><a href="?i=sablonlar"><i class="fa fa-list"></i> Alt Özellik Şablonları</a></li>
												<li><a href="?i=degerler"><i class="fa fa-list"></i> Alt Özellik Değerleri</a></li>
											</ul>
										</li>
										
										<li>
											<a href="?i=gelen-odemeler" aria-expanded="true">
												<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Gelen Ödemeler</span>
											</a>
											
										</li>

										<li>
											<a href="?i=uyeler" aria-expanded="true">
												<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Kullanıcılar</span>
											</a>
											
										</li>

										<li>
											<a href="?i=sayfa&s=tur" aria-expanded="true">
												<span class="glyphicon fa fa-send" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Turlar</span>
											</a>
										</li>
										<li>
											<a href="#" aria-expanded="true">
												<span class="glyphicon fa fa-language" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Çeviriler</span>
												<span class="fa arrow"></span>
											</a>
											<ul aria-expanded="true" class="collapse">
												<li>
													<a href="?i=ceviri_tablo"><i class="glyphicon fa fa-language"></i> Çeviri Tablosu</a>
												</li>
												<li>
													<a href="?i=yeniDil"><i class="glyphicon fa fa-plus"></i> Yeni Dil Ekle</a>
												</li>
												<?php $diller = ksorgu("diller");
												while($d = kd($diller)) {
												?>
												<li>
													<a href="?i=dil&d=<?php e($d['kisa']) ?>"><span class="glyphicon flag-icon flag-icon-<?php e($d['kisa']) ?>"></span><?php e($d['isim']) ?> </a>
													<a href="?dilSil=<?php e($d['id']) ?>" class="sag-buton" teyit="<?php e($d['isim']) ?> dilini kaldırmak istediğinizden emin misiniz" ><i class="fa fa-trash"></i></a>
												</li>
												<?php } ?>
												
											</ul>
										</li>

										<li>
											<a href="?i=profil" aria-expanded="true">
												<span class="glyphicon fa fa-user" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Profil</span>
												
											</a>
										</li>

										<li>
											<a href="?i=type" aria-expanded="true">
												<span class="glyphicon fa fa-file-text-o" aria-hidden="true"></span>
												<span class="sidebar-nav-item">İçerik Tipleri</span>
												
											</a>
										</li>
										<li>
											<a href="?i=dosya" aria-expanded="true">
												<span class="glyphicon fa fa-file" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Dosya Yöneticisi</span>
												
											</a>
										</li>
										
										<li>
											<a href="?i=ayarlar" aria-expanded="true">
												<span class="glyphicon fa fa-cog" aria-hidden="true"></span>
												<span class="sidebar-nav-item">Site Ayarları</span>
												
											</a>
										</li>
										
									</ul>
								