<?= $this->include('template/admin_header'); ?>

<style>
.wrap { padding: 1.5rem; }
.page-title { font-size: 22px; font-weight: 500; margin-bottom: 1.5rem; }
.toolbar { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 1.25rem; flex-wrap: wrap; }
.search-box { display: flex; gap: 8px; align-items: center; }
.search-box input[type=text] { width: 260px; height: 36px; padding: 0 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 14px; }
.btn { display: inline-flex; align-items: center; gap: 6px; padding: 0 14px; height: 36px; border-radius: 8px; font-size: 14px; border: 1px solid #ccc; background: #fff; color: #333; cursor: pointer; text-decoration: none; }
.btn-primary { background: #185FA5; border-color: #185FA5; color: #fff; }
.btn-primary:hover { background: #0C447C; }
.btn-danger { background: #A32D2D; border-color: #A32D2D; color: #fff; }
.btn-danger:hover { background: #791F1F; }
.table-card { background: #fff; border: 1px solid #e5e5e5; border-radius: 12px; overflow: hidden; }
table { width: 100%; border-collapse: collapse; font-size: 14px; }
thead th { padding: 12px 16px; text-align: left; font-size: 12px; font-weight: 500; color: #888; text-transform: uppercase; letter-spacing: 0.04em; border-bottom: 1px solid #e5e5e5; }
tbody tr { border-bottom: 1px solid #f0f0f0; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: #f9f9f9; }
td { padding: 12px 16px; vertical-align: middle; }
.td-id { color: #999; font-size: 13px; width: 48px; }
.td-judul p {
    font-size: 12px;
    color: #999;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 500px;
}
.badge { display: inline-block; padding: 3px 10px; border-radius: 99px; font-size: 12px; font-weight: 500; }
.badge-publish { background: #EAF3DE; color: #3B6D11; }
.badge-draft { background: #F1EFE8; color: #5F5E5A; }
.aksi-wrap { display: flex; gap: 6px; }
.pager-wrap { padding: 12px 16px; border-top: 1px solid #e5e5e5; }
.pagination { display: flex; gap: 6px; list-style: none; padding: 0; margin: 0; }
.pagination li a,
.pagination li span { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e5e5e5; background: #fff; color: #333; font-size: 13px; text-decoration: none; }
.pagination li.active span { background: #185FA5; border-color: #185FA5; color: #fff; }
.pagination li a:hover { background: #f0f0f0; }
.pagination li.disabled span { color: #ccc; cursor: not-allowed; }
</style>

<div class="wrap">
    <h1 class="page-title">Daftar Artikel</h1>

    <div class="toolbar">
        <form method="get" class="search-box">
            <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari judul artikel...">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <a href="<?= base_url('/admin/artikel/add'); ?>" class="btn btn-primary">+ Tambah Artikel</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($artikel): foreach($artikel as $row): ?>
                <tr>
                    <td class="td-id"><?= $row['id']; ?></td>
                    <td class="td-judul">
                        <b><?= $row['judul']; ?></b>
                        <p><?= substr($row['isi'], 0, 60); ?></p>
                    </td>
                    <td>
                        <?php if($row['status'] == 1): ?>
                            <span class="badge badge-publish">Publish</span>
                        <?php else: ?>
                            <span class="badge badge-draft">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="aksi-wrap">
                            <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                            <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="4" style="text-align:center; color:#999; padding: 2rem;">Belum ada data.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pager-wrap" style="display:flex; align-items:center; gap:8px;">
            <?= $pager->only(['q'])->links(); ?>
        </div>
    </div>
</div>

<?= $this->include('template/admin_footer'); ?>