function deleteClick(int_review) {
    if (!confirm("한번 삭제한 데이터는 복구할 수 없습니다.\n정말로 삭제하시겠습니까?")) return
    location.href="edit_proc.php?RetrieveFlag=DELETE&int_review=" + int_review;
}