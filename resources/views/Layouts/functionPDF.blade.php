@php
    function formatCatatan($text)
    {
        // Escape dulu biar aman
        $escaped = e($text);

        // Pisahkan per baris
        $lines = preg_split('/\r\n|\r|\n/', $escaped);

        $output = '';
        $isList = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                continue; // skip baris kosong
            }

            // Kalau baris mulai dengan "- " atau "• "
            if (preg_match('/^[-•]\s+/', $trimmed)) {
                if (!$isList) {
                    $output .= '<ul style="margin:0; padding-left:20px;">';
                    $isList = true;
                }
                // hapus tanda -/• di depan lalu masukkan ke <li>
                $item = preg_replace('/^[-•]\s+/', '', $trimmed);
                $output .= "<li>{$item}</li>";
            } else {
                // Kalau sebelumnya dalam list, tutup dulu
                if ($isList) {
                    $output .= '</ul>';
                    $isList = false;
                }
                // Baris biasa → pakai <p>
                $output .= "<p style='margin:0;'>{$trimmed}</p>";
            }
        }

        // Tutup list terakhir kalau masih terbuka
        if ($isList) {
            $output .= '</ul>';
        }

        return $output;
    }
@endphp
