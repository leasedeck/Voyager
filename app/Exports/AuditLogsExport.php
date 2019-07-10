<?php 

namespace App\Exports;

use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\{WithHeadings, Exportable, ShouldAutoSize, WithEvents, WithMapping, FromCollection};
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;

class AuditLogsExport implements WithHeadings, ShouldAutoSize, WithEvents, WithMapping, FromCollection
{
    use Exportable; 

    public function __construct(?string $criteria)
    {
        $this->criteria = $criteria;
    }

    public function map($log): array
    {
        return [$log->causer->name, $log->log_name, $log->description, $log->created_at->format('d-m-Y H:i:s')];
    }

    public function headings(): array
    {
        return ['Persoon:', 'Categorie:', 'Handeling:', 'Datum:'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event): void {
                $event->sheet->getDelegate()->getStyle('A1:E1')->getFont()->setBold(true);
            },
        ];
    }

    public function collection(): Collection
    {
        return $this->getResultsByCriteria();
    }

    protected function getResultsByCriteria(): Collection
    {
        $query = Activity::query();

        switch ($this->criteria) {
            case '3-months':    return $query->whereBetween('created_at', [now()->subMonths(3), now()])->get();
            case '6-months':    return $query->whereBetween('created_at', [now()->subMonths(6), now()])->get();
            case 'recent-year': return $query->whereBetween('created_at', [now()->subYear(), now()])->get();
            default:            return $query->get();
        }
    }
}
