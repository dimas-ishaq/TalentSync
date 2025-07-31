// validasi ada 2 yaitu create dan edit

export const rulesCreatePenggajian = [
    {
        id: "create_tunjangan_tetap",
        validations: [
            {
                type: "required",
                message: "Tunjangan tetap wajib di isi",
            },
            {
                type: "min",
                value: 1000000,
                message: "Tunjangan tetap minimum 1 juta",
            },
        ],
    },
    {
        id: "create_tunjangan_tidak_tetap",
        validations: [
            {
                type: "required",
                message: "Tunjangan tidak tetap wajib di isi",
            },
            {
                type: "min",
                value: 500000,
                message: "Tunjangan tidak tetap minimum 500 ribu",
            },
        ],
    },
    {
        id: "create_pot_bpjs_kesehatan",
        validations: [
            {
                type: "required",
                message: "Potongan BPJS Kesehatan wajib di isi",
            },
        ],
    },
    {
        id: "create_pot_bpjs_ketenagakerjaan",
        validations: [
            {
                type: "required",
                message: "Potongan BPJS Ketenagakerjaan wajib di isi ",
            },
        ],
    },
    {
        id: "create_pot_pph21",
        validations: [
            {
                type: "required",
                message: "Potongan PPH21 wajib di isi",
            },
        ],
    },
    {
        id: "create_pot_pinjaman",
        validations: [
            {
                type: "required",
                message: "Potongan pinjaman wajib di isi",
            },
        ],
    },
    {
        id: "create_pot_denda",
        validations: [
            {
                type: "required",
                message: "Potongan denda wajib di isi",
            },
        ],
    },
];

export const rulesEditPenggajian = [
    {
        id: "edit_tunjangan_tetap",
        validations: [
            {
                type: "required",
                message: "Tunjangan tetap wajib di isi",
            },
            {
                type: "min",
                value: 1000000,
                message: "Tunjangan tetap minimum 1 juta",
            },
        ],
    },
    {
        id: "edit_tunjangan_tidak_tetap",
        validations: [
            {
                type: "required",
                message: "Tunjangan tidak tetap wajib di isi",
            },
            {
                type: "min",
                value: 500000,
                message: "Tunjangan tidak tetap minimum 500 ribu",
            },
        ],
    },
    {
        id: "edit_pot_bpjs_kesehatan",
        validations: [
            {
                type: "required",
                message: "Potongan BPJS Kesehatan wajib di isi",
            },
        ],
    },
    {
        id: "edit_pot_bpjs_ketenagakerjaan",
        validations: [
            {
                type: "required",
                message: "Potongan BPJS Ketenagakerjaan wajib di isi ",
            },
        ],
    },
    {
        id: "edit_pot_pph21",
        validations: [
            {
                type: "required",
                message: "Potongan PPH21 wajib di isi",
            },
        ],
    },
    {
        id: "edit_pot_pinjaman",
        validations: [
            {
                type: "required",
                message: "Potongan pinjaman wajib di isi",
            },
        ],
    },
    {
        id: "edit_pot_denda",
        validations: [
            {
                type: "required",
                message: "Potongan denda wajib di isi",
            },
        ],
    },
];

