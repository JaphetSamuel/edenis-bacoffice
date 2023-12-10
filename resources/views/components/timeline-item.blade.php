@props(['completed'=>false,'label'=>'label'])

<div class="timeline-item">
    @if($completed)
        <i class="fas fa-check-circle text-success"></i>
    @else
        <i class="fas fa-times-circle text-danger"></i>
    @endif
    <p class="ml-5">{{ $label }}</p>
</div>
